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

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/personajes/{juego}', name: 'api_personajes_por_juego', methods: ['GET'])]
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