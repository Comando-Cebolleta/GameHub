<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class FileUploadController extends AbstractController
{
    // De forma resumida, este controller hace de intermediario entre symfony y CKE
    // para que CKE sepa donde guardar las imagenes que se suban
    #[Route('/upload/post-image', name: 'upload_post_image', methods: ['POST'])]
    public function upload(
        Request $request, 
        SluggerInterface $slugger,
        #[Autowire('%uploads_directory%')] string $uploadsDirectory
    ): JsonResponse
    {
        // CKEditor envía el archivo bajo el nombre 'upload'
        $file = $request->files->get('upload');

        if (!$file) {
            return new JsonResponse(['error' => ['message' => 'No se ha subido ninguna imagen.']], 400);
        }

        // Generar nombre seguro
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move(
                $uploadsDirectory,
                $newFilename
            );
        } catch (\Exception $e) {
            return new JsonResponse(['error' => ['message' => 'Error al guardar la imagen: ' . $e->getMessage()]], 500);
        }

        // Devolver JSON al ckeditor
        return new JsonResponse([
            'url' => '/uploads/blog/' . $newFilename
        ]);
    }
}