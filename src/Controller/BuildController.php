<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Artefacto;
use App\Entity\Arma;
use App\Form\PersonajeType;
use App\Entity\SetArtefactos;
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
    #[Route('/crear', name: 'app_build_create')]
    #[IsGranted('ROLE_USER')] // Solo usuarios logueados pueden crear builds
    public function create(
        Request $request, 
        EntityManagerInterface $em,
        ArtefactoPlantillaRepository $repoPlantillas): Response
    {
        $personaje = new Personaje();
        
        // Inicializamos el Arma vacía para que el formulario no falle al intentar acceder a ella
        $arma = new Arma();
        $personaje->setArma($arma);

        $form = $this->createForm(PersonajeType::class, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Asignar el Usuario actual (Dueño de la build)
            $personaje->setUser($this->getUser());

            $slots = [
            'artefacto_flor' => 'flor',
            'artefacto_pluma' => 'pluma',
            'artefacto_reloj' => 'reloj',
            'artefacto_copa' => 'caliz',
            'artefacto_casco' => 'sombrero'
            ];

            foreach ($slots as $campoForm => $codigoTipoBD) {
            
                // 1. Sacamos el subformulario
                $subForm = $form->get($campoForm);
                
                /** @var Artefacto $artefactoEntity */
                $artefactoEntity = $subForm->getData(); // Aquí viene vacío de plantilla

                // 2. Obtenemos el SET que seleccionó el usuario
                /** @var SetArtefactos $setSeleccionado */
                $setSeleccionado = $subForm->get('setSeleccionado')->getData();

                // 3. BUSCAMOS LA PIEZA EXACTA EN LA BD
                // "Búscame la pieza del set 'Gladiador' que sea tipo 'Flor'"
                $plantillaExacta = $repoPlantillas->findOneBySetAndType($setSeleccionado, $codigoTipoBD);

                if (!$plantillaExacta) {
                    // Error de seguridad por si la BD está incompleta
                    $this->addFlash('error', "No se encontró la pieza $codigoTipoBD del set " . $setSeleccionado->getNombre());
                    return $this->redirectToRoute('app_build_create'); 
                }

                // 4. Asignamos la plantilla encontrada a la entidad
                $artefactoEntity->setArtefactoPlantilla($plantillaExacta);

                // 5. Procesamos Stats (JSON) y guardamos
                $jsonStats = [
                    'main_stat' => [
                        'name' => $subForm->get('statPrincipalNombre')->getData(),
                        'value' => $subForm->get('statPrincipalValor')->getData()
                    ],
                    'sub_stats' => [] 
                ];
                $artefactoEntity->setEstadisticas($jsonStats);
                
                $personaje->addArtefacto($artefactoEntity);
            }
            
            $em->persist($personaje);
            $em->flush();

            $this->addFlash('success', '¡Build creada con éxito!');

            // Redirigir al perfil del usuario o a la lista de builds
            return $this->redirectToRoute('home'); 
        }

        return $this->render('build/create_build.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // --- API PARA AJAX (Requisito de tu Memoria) ---
    
    #[Route('/api/personajes/{juego}', name: 'api_personajes_por_juego', methods: ['GET'])]
    public function getPersonajesApi(string $juego, PersonajePlantillaRepository $repo): JsonResponse
    {
        // Busca las plantillas (Raiden, Kafka, etc.) que sean de ese juego
        $plantillas = $repo->findBy(['juego' => $juego]);

        $data = [];
        foreach ($plantillas as $p) {
            $data[] = [
                'id' => $p->getId(),
                'nombre' => $p->getNombre(),
                'imagen' => $p->getImagen() // Útil si quieres mostrar la cara del PJ en el select
            ];
        }

        return new JsonResponse($data);
    }
}