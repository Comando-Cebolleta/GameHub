<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Artefacto;
use App\Form\GenshinBuildType;
use App\Form\HonkaiBuildType;
use App\Repository\ArmaPlantillaRepository;
use App\Repository\PersonajePlantillaRepository;
use App\Repository\ArtefactoPlantillaRepository;
use App\Repository\SetArtefactosRepository;
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

    #[Route('/personaje/{id}/habilidades', name: 'api_personaje_habilidades', methods: ['GET'])]
    public function getHabilidadesApi(int $id, PersonajePlantillaRepository $repo): JsonResponse
    {
        $plantilla = $repo->find($id);

        if (!$plantilla) {
            return new JsonResponse(['error' => 'Personaje no encontrado'], 404);
        }

        $habilidades = $plantilla->getHabilidades();
        $data = [];

        foreach ($habilidades as $habilidad) {
            $data[] = [
                'id' => $habilidad->getId(),
                'nombre' => $habilidad->getNombre(),
                'efectos' => $habilidad->getEfectos()
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/personaje/{id}/imagen', name: 'api_personaje_imagen', methods: ['GET'])]
    public function getImagenPersonajeApi(int $id, PersonajePlantillaRepository $repo): JsonResponse
    {
        $plantilla = $repo->find($id);

        if (!$plantilla) {
            return new JsonResponse(['error' => 'Personaje no encontrado'], 404);
        }

        return new JsonResponse(['imagen' => $plantilla->getImagen()]);
    }

    #[Route('/arma/{id}/imagen', name: 'api_arma_imagen', methods: ['GET'])]
    public function getImagenArmaApi(int $id, ArmaPlantillaRepository $repo): JsonResponse
    {
        $plantilla = $repo->find($id);

        if (!$plantilla) {
            return new JsonResponse(['error' => 'Arma no encontrada'], 404);
        }

        return new JsonResponse(['imagen' => $plantilla->getImagen()]);
    }

    #[Route('/artefacto/{idSet}/set/{set}/imagen', name: 'api_artefacto_imagen', methods: ['GET'])]
    public function getImagenArtefactoApi(int $idSet, string $set, ArtefactoPlantillaRepository $repo, SetArtefactosRepository $setRepo): JsonResponse
    {
        $plantilla = $repo->findOneBySetAndType(
            $setRepo->find($idSet),
            $set
        );

        if (!$plantilla) {
            return new JsonResponse(['error' => 'Artefacto no encontrado'], 404);
        }

        return new JsonResponse([
            'imagen' => $plantilla->getImagen(),
            'idSet' => $plantilla->getSetArtefactos()->getId()]);
    }

    #[Route('/set/{idSet}/cantidad/{cantidad}/efectos', name: 'api_set_efectos', methods: ['GET'])]
    public function getSetEfectos(int $idSet, int $cantidad, SetArtefactosRepository $setRepo): JsonResponse
    {
        $set = $setRepo->find($idSet);

        if (!$set) {
            return new JsonResponse(['error' => 'Set no encontrado'], 404);
        }

        $efectos = $set->getEfectosSum($cantidad);

        if (empty($efectos)) {
            return new JsonResponse(['error' => 'No hay efectos para esa cantidad'], 404);
        }

        return new JsonResponse(['efectos' => $efectos]);
    }
}