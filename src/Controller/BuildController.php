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
            return $this->redirectToRoute('home'); // OJO: Cambia 'app_index' por la ruta de tu home (ej: 'home')
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

    private function procesarArtefactos($form, $slots, $personaje, $repoPlantillas) {
        foreach ($slots as $campoForm => $codigoTipoBD) {
            if (!$form->has($campoForm)) continue;
            $subForm = $form->get($campoForm);
            /** @var Artefacto $artefactoEntity */
            $artefactoEntity = $subForm->getData();
            $setSeleccionado = $subForm->get('setSeleccionado')->getData();
            
            if (!$setSeleccionado) continue;

            $plantillaExacta = $repoPlantillas->findOneBySetAndType($setSeleccionado, $codigoTipoBD);
            if ($plantillaExacta) {
                $artefactoEntity->setArtefactoPlantilla($plantillaExacta);
                $jsonStats = [
                    'main_stat' => ['name' => $subForm->get('statPrincipalNombre')->getData(), 'value' => $subForm->get('statPrincipalValor')->getData()],
                    'sub_stats' => []
                ];
                $artefactoEntity->setEstadisticas($jsonStats);
                $personaje->addArtefacto($artefactoEntity);
            }
        }
    }

    #[Route('/api/personajes/{juego}', name: 'api_personajes_por_juego', methods: ['GET'])]
    public function getPersonajesApi(string $juego, PersonajePlantillaRepository $repo): JsonResponse
    {
        $plantillas = $repo->findBy(['juego' => $juego]);
        $data = [];
        foreach ($plantillas as $p) {
            $data[] = ['id' => $p->getId(), 'nombre' => $p->getNombre()];
        }
        return new JsonResponse($data);
    }
}