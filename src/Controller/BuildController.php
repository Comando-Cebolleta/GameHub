<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Artefacto;
use App\Form\GenshinBuildType;
use App\Form\HonkaiBuildType;
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
            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas);

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
            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas);

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

        return $this->render('build/single_build.html.twig', ['build' => $personaje, 'esMio' => $esMio]);
    }

    private function procesarArtefactos($form, $slots, $personaje, $repoPlantillas)
    {
        foreach ($slots as $campoForm => $codigoTipoBD) {
            if (!$form->has($campoForm)) continue;

            $subForm = $form->get($campoForm);
            $setSeleccionado = $subForm->get('setSeleccionado')->getData();

            if (!$setSeleccionado) continue;

            /** @var Artefacto $artefactoEntity */
            $artefactoEntity = $subForm->getData();

            $plantillaExacta = $repoPlantillas->findOneBySetAndType($setSeleccionado, $codigoTipoBD);

            if ($plantillaExacta) {
                $artefactoEntity->setArtefactoPlantilla($plantillaExacta);

                $mainStat = [
                    'name' => $subForm->get('statPrincipalNombre')->getData(),
                    'value' => $subForm->get('statPrincipalValor')->getData()
                ];

                $subStatsArray = [];
                for ($i = 1; $i <= 4; $i++) {
                    $nombre = $subForm->get('subStatNombre' . $i)->getData();
                    $valor = $subForm->get('subStatValor' . $i)->getData();

                    // Solo guardamos si hay nombre y valor (evitamos guardar nulls)
                    if ($nombre && $valor !== null) {
                        $subStatsArray[] = [
                            'name' => $nombre,
                            'value' => $valor
                        ];
                    }
                }

                // Montar el JSON final
                $jsonStats = [
                    'main_stat' => $mainStat,
                    'sub_stats' => $subStatsArray
                ];

                $artefactoEntity->setEstadisticas($jsonStats);
                $personaje->addArtefacto($artefactoEntity);
            }
        }
    }

    #[Route('/{id}/edit', name: 'app_build_edit')]
    #[IsGranted('ROLE_USER')]
    public function editBuild(Personaje $personaje, Request $request, EntityManagerInterface $em, ArtefactoPlantillaRepository $repoPlantillas): Response
    {
        if ($personaje->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $esGenshin = true;
        $primerArtefacto = $personaje->getArtefactos()->first();

        if ($primerArtefacto) {
            $plantilla = $primerArtefacto->getArtefactoPlantilla();
            // CORRECCIÓN: Usamos getPiezaTipo()
            $tipo = $plantilla->getPiezaTipo();

            // Si la pieza es de Honkai (cabeza, manos, etc.), esGenshin pasa a false
            $piezasHonkai = ['cabeza', 'manos', 'torso', 'pies', 'esfera', 'cuerda'];
            if (in_array($tipo, $piezasHonkai)) {
                $esGenshin = false;
            }
        }

        $formType = $esGenshin ? GenshinBuildType::class : HonkaiBuildType::class;
        $form = $this->createForm($formType, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slots = $esGenshin
                ? ['artefacto_flor' => 'flor', 'artefacto_pluma' => 'pluma', 'artefacto_reloj' => 'reloj', 'artefacto_copa' => 'caliz', 'artefacto_casco' => 'sombrero']
                : ['reliquia_cabeza' => 'cabeza', 'reliquia_manos' => 'manos', 'reliquia_torso' => 'torso', 'reliquia_pies' => 'pies', 'ornamento_esfera' => 'esfera', 'ornamento_cuerda' => 'cuerda'];

            $this->procesarArtefactos($form, $slots, $personaje, $repoPlantillas);

            $em->flush();
            $this->addFlash('success', '¡Build actualizada correctamente!');
            return $this->redirectToRoute('app_profile_builds');
        }

        return $this->render($esGenshin ? 'build/create_genshin.html.twig' : 'build/create_hsr.html.twig', [
            'form' => $form->createView(),
            'edit_mode' => true,
            'personaje' => $personaje
        ]);
    }

    #[Route('/{id}/delete', name: 'app_build_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function deleteBuild(Request $request, Personaje $personaje, EntityManagerInterface $em): Response
    {
        if ($personaje->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $personaje->getId(), $request->request->get('_token'))) {
            $em->remove($personaje);
            $em->flush();
            $this->addFlash('success', 'Build eliminada.');
        }

        return $this->redirectToRoute('app_profile_builds');
    }
}