<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Repository\PersonajeRepository;
use App\Entity\Artefacto;
use App\Form\GenshinBuildType;
use App\Form\HonkaiBuildType;
use App\Form\GenshinArtefactoType;
use App\Form\HonkaiArtefactoType;
use App\Repository\ArtefactoPlantillaRepository;
use App\Repository\PersonajePlantillaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/build')]
class BuildController extends AbstractController
{
    // --- RUTA GENSHIN ---
    #[Route('/genshin/crear', name: 'app_build_genshin_create')]
    #[IsGranted('ROLE_USER')]
    public function createGenshin(Request $request, EntityManagerInterface $em, ArtefactoPlantillaRepository $repoPlantillas): Response
    {
        $personaje = new Personaje();
        $personaje->setUser($this->getUser());

        $form = $this->createForm(GenshinBuildType::class, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slots = ['artefacto_flor' => 'flor', 'artefacto_pluma' => 'pluma', 'artefacto_reloj' => 'reloj', 'artefacto_copa' => 'caliz', 'artefacto_casco' => 'sombrero'];
            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas, $em);

            $em->persist($personaje);
            $em->flush();

            $this->addFlash('success', '¡Build de Genshin creada!');
            return $this->redirectToRoute('home');
        }

        return $this->render('build/create_genshin.html.twig', ['form' => $form->createView()]);
    }

    // --- RUTA HONKAI ---
    #[Route('/hsr/crear', name: 'app_build_hsr_create')]
    #[IsGranted('ROLE_USER')]
    public function createHonkai(Request $request, EntityManagerInterface $em, ArtefactoPlantillaRepository $repoPlantillas): Response
    {
        $personaje = new Personaje();
        $personaje->setUser($this->getUser());

        $form = $this->createForm(HonkaiBuildType::class, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slots = ['reliquia_cabeza' => 'cabeza', 'reliquia_manos' => 'manos', 'reliquia_torso' => 'torso', 'reliquia_pies' => 'pies', 'ornamento_esfera' => 'esfera', 'ornamento_cuerda' => 'cuerda'];
            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas, $em);

            $em->persist($personaje);
            $em->flush();

            $this->addFlash('success', '¡Build de Honkai creada!');
            return $this->redirectToRoute('home');
        }

        return $this->render('build/create_hsr.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/{id}', name: 'app_build_view')]
    public function viewBuild(Personaje $personaje): Response
    {
        $esMio = $this->getUser() && $personaje->getUser() && $this->getUser()->getId() === $personaje->getUser()->getId();

        // Sacamos los arrays de stats desde los formularios para usarlos en el twig y mostrar los nombres legibles de las stats
        $statsGenshin = GenshinArtefactoType::STATS_GENSHIN;
        $statsHsr = HonkaiArtefactoType::STATS_HSR;

        // Los juntamos
        $todasLasStats = array_merge($statsGenshin, $statsHsr);

        // Pasamos de array de 'nombre legible' => 'clave_interna' a 'clave_interna' => 'nombre legible' para fácil acceso en twig
        $diccionarioStats = array_flip($todasLasStats);

        return $this->render('build/single_build.html.twig', [
            'build' => $personaje, 
            'esMio' => $esMio,
            'diccionarioStats' => $diccionarioStats
        ]);
    }

    private function procesarArtefactos($form, $slots, $personaje, $repoPlantillas, EntityManagerInterface $em)
    {
        // Mapear artefactos existentes por su tipo para acceso rápido
        $artefactosExistentes = [];
        foreach ($personaje->getArtefactos() as $artefacto) {
            if ($artefacto->getArtefactoPlantilla() && $artefacto->getArtefactoPlantilla()->getPiezaTipo()) {
                $codigo = $artefacto->getArtefactoPlantilla()->getPiezaTipo()->getCodigo();
                $artefactosExistentes[$codigo] = $artefacto;
            }
        }

        foreach ($slots as $campoForm => $codigoTipoBD) {
            if (!$form->has($campoForm)) continue;

            $subForm = $form->get($campoForm);
            $setSeleccionado = $subForm->get('setSeleccionado')->getData();

            // Si no se selecciona nada en el formulario para este slot, pasamos
            if (!$setSeleccionado) continue;

            // BUSCAMOS LA PLANTILLA
            $plantillaExacta = $repoPlantillas->findOneBySetAndType($setSeleccionado, $codigoTipoBD);

            if ($plantillaExacta) {
                // ¿Actualizar o Crear?
                if (isset($artefactosExistentes[$codigoTipoBD])) {
                    // --- ACTUALIZAR EXISTENTE ---
                    $artefactoEntity = $artefactosExistentes[$codigoTipoBD];
                } else {
                    // --- CREAR NUEVO ---
                    $artefactoEntity = new Artefacto();
                    $personaje->addArtefacto($artefactoEntity);
                    $em->persist($artefactoEntity); 
                }

                $artefactoEntity->setArtefactoPlantilla($plantillaExacta);

                $mainStat = [
                    'name' => $subForm->get('statPrincipalNombre')->getData(),
                    'value' => $subForm->get('statPrincipalValor')->getData()
                ];

                $subStatsArray = [];
                for ($i = 1; $i <= 4; $i++) {
                    $nombre = $subForm->get('subStatNombre' . $i)->getData();
                    $valor = $subForm->get('subStatValor' . $i)->getData();

                    if ($nombre && $valor !== null) {
                        $subStatsArray[] = [
                            'name' => $nombre,
                            'value' => $valor
                        ];
                    }
                }

                $jsonStats = [
                    'main_stat' => $mainStat,
                    'sub_stats' => $subStatsArray
                ];

                $artefactoEntity->setEstadisticas($jsonStats);
            }
        }
    }

    // --- RUTA EDICIÓN GENSHIN ---
    #[Route('/genshin/editar/{id}', name: 'app_build_genshin_edit')]
    #[IsGranted('ROLE_USER')]
    public function editGenshin(
        Personaje $personaje,
        Request $request,
        EntityManagerInterface $em,
        ArtefactoPlantillaRepository $repoPlantillas
    ): Response {
        // Seguridad
        if ($personaje->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('No puedes editar esta build.');
        }

        $form = $this->createForm(GenshinBuildType::class, $personaje, [
            'is_edit' => true // Pasamos esta opción para que el formulario sepa que es edición y no creación
        ]);

        // PRELLENADO INTELIGENTE (JSON -> Formulario)
        $mapaCampos = [
            'flor' => 'artefacto_flor',
            'pluma' => 'artefacto_pluma',
            'reloj' => 'artefacto_reloj',
            'caliz' => 'artefacto_copa',
            'sombrero' => 'artefacto_casco'
        ];
        $this->prellenarDatosArtefactos($form, $personaje, $mapaCampos);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slots = array_flip($mapaCampos); // Invierte el array para obtener ['artefacto_flor' => 'flor', ...]
            
            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas, $em);

            $em->flush();

            $this->addFlash('success', '¡Build de Genshin actualizada!');

            return $this->redirectToRoute('app_profile', [
                'id' => $this->getUser()->getId()
            ]);
        }

        return $this->render('build/create_genshin.html.twig', [
            'form' => $form->createView(),
            'is_edit' => true
        ]);
    }

    // --- RUTA EDICIÓN HONKAI ---
    #[Route('/hsr/editar/{id}', name: 'app_build_hsr_edit')]
    #[IsGranted('ROLE_USER')]
    public function editHonkai(
        Personaje $personaje,
        Request $request,
        EntityManagerInterface $em,
        ArtefactoPlantillaRepository $repoPlantillas
    ): Response {
        if ($personaje->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('No puedes editar esta build.');
        }

        $form = $this->createForm(HonkaiBuildType::class, $personaje, [
            'is_edit' => true
        ]);

        $mapaCampos = [
            'cabeza' => 'reliquia_cabeza',
            'manos' => 'reliquia_manos',
            'torso' => 'reliquia_torso',
            'pies' => 'reliquia_pies',
            'esfera' => 'ornamento_esfera',
            'cuerda' => 'ornamento_cuerda'
        ];
        $this->prellenarDatosArtefactos($form, $personaje, $mapaCampos);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slots = array_flip($mapaCampos);
            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas, $em);

            $em->flush();

            $this->addFlash('success', '¡Build de Honkai actualizada!');
            return $this->redirectToRoute('app_profile', [
                'id' => $this->getUser()->getId()
            ]);
        }

        return $this->render('build/create_hsr.html.twig', [
            'form' => $form->createView(),
            'is_edit' => true
        ]);
    }

    private function prellenarDatosArtefactos($form, $personaje, $mapaCampos)
    {
        foreach ($personaje->getArtefactos() as $artefacto) {
            // Obtener el tipo de pieza (flor, casco, cabeza, etc.)
            if (!$artefacto->getArtefactoPlantilla()) continue;
            
            $tipo = $artefacto->getArtefactoPlantilla()->getPiezaTipo()->getCodigo();

            if (isset($mapaCampos[$tipo]) && $form->has($mapaCampos[$tipo])) {
                $subForm = $form->get($mapaCampos[$tipo]);

                // Poner el Objeto Artefacto (para que el ID interno se mantenga)
                $subForm->setData($artefacto);

                // Poner el SET seleccionado
                // Buscamos el Set al que pertenece la plantilla del artefacto
                $setDelArtefacto = $artefacto->getArtefactoPlantilla()->getSetArtefactos();
                if ($subForm->has('setSeleccionado')) {
                    $subForm->get('setSeleccionado')->setData($setDelArtefacto);
                }

                // DESEMPAQUETAR EL JSON DE ESTADISTICAS
                $stats = $artefacto->getEstadisticas(); // Esto devuelve el array ['main_stat' => ..., 'sub_stats' => ...]

                if ($stats) {
                    // Stat Principal
                    if (isset($stats['main_stat']) && $subForm->has('statPrincipalNombre')) {
                        $subForm->get('statPrincipalNombre')->setData($stats['main_stat']['name']);
                        $subForm->get('statPrincipalValor')->setData($stats['main_stat']['value']);
                    }

                    // Substats
                    if (isset($stats['sub_stats']) && is_array($stats['sub_stats'])) {
                        foreach ($stats['sub_stats'] as $index => $subStat) {
                            $num = $index + 1;
                            
                            if ($subForm->has('subStatNombre' . $num)) {
                                $subForm->get('subStatNombre' . $num)->setData($subStat['name']);
                                $subForm->get('subStatValor' . $num)->setData($subStat['value']);
                            }
                        }
                    }
                }
            }
        }
    }

    #[Route('/borrar/{id}', name: 'app_build_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Personaje $personaje, EntityManagerInterface $em): Response
    {
        // Verificar seguridad: solo el dueño puede borrar
        if ($personaje->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('No puedes borrar esta build.');
        }

        // Verificar token CSRF
        if ($this->isCsrfTokenValid('delete'.$personaje->getId(), $request->request->get('_token'))) {
            
            // Borrar primero los artefactos asociados
            foreach ($personaje->getArtefactos() as $artefacto) {
                $personaje->removeArtefacto($artefacto);
                $em->remove($artefacto);
            }

            $em->remove($personaje);
            $em->flush();
            
            $this->addFlash('success', 'Build eliminada correctamente.');
        }

        return $this->redirectToRoute('app_profile'); 
    }
}