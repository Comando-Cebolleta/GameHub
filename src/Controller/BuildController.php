<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Artefacto;
use App\Entity\Arma;
use App\Form\PersonajeType;
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
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $personaje = new Personaje();
        
        // Inicializamos el Arma vacía para que el formulario no falle al intentar acceder a ella
        $arma = new Arma();
        $personaje->setArma($arma);

        $form = $this->createForm(PersonajeType::class, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // 1. Asignar el Usuario actual (Dueño de la build)
            $personaje->setUser($this->getUser());

            // 2. PROCESAMIENTO MANUAL DEL JSON DE ARTEFACTOS
            // Recorremos los sub-formularios de artefactos para sacar los datos "no mapeados"
            foreach ($form->get('artefactos') as $artefactoForm) {
                /** @var Artefacto $artefactoEntity */
                $artefactoEntity = $artefactoForm->getData();
                
                // Obtenemos los valores de los campos que pusimos 'mapped' => false
                $statNombre = $artefactoForm->get('statPrincipalNombre')->getData();
                $statValor = $artefactoForm->get('statPrincipalValor')->getData();

                // Construimos el array (que Doctrine guardará como JSON)
                $jsonStats = [
                    'main_stat' => [
                        'name' => $statNombre,
                        'value' => $statValor
                    ],
                    // Aquí podrías añadir sub-stats si amplias el formulario en el futuro
                    'sub_stats' => [] 
                ];

                // Guardamos el JSON en la entidad
                $artefactoEntity->setEstadisticas($jsonStats);
                
                // Vinculamos el artefacto al personaje (por si el cascade no lo pilla)
                $personaje->addArtefacto($artefactoEntity);
            }

            // 3. Persistir todo (Gracias al cascade=['persist'] en las entidades, 
            // al guardar Personaje se guardan el Arma y los Artefactos solos)
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