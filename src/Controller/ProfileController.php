<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Post;
use App\Form\PostFormType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/profile')]
final class ProfileController extends AbstractController
{
    #[Route('/builds', name: 'app_profile_builds')]
    #[IsGranted('ROLE_USER')]
    public function profileBuilds(): Response
    {
        $user = $this->getUser();

        // Recordad que "builds" en realidad es personajes en la base de datos
        $builds = $user->getPersonajes();

        return $this->render('profile/misBuilds.html.twig', [
            'builds' => $builds
        ]);
    }

    #[Route('/posts', name: 'app_profile_posts')]
    #[IsGranted('ROLE_USER')]
    public function profilePosts(): Response
    {
        $user = $this->getUser();
        $posts = $user->getPosts();

        return $this->render('profile/misPosts.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/{id}', name: 'app_profile', defaults: ['id' => null])]
    #[IsGranted('ROLE_USER')]
    public function perfil(?User $user): Response
    {
        if ($user) {
            // Si se ha proporcionado un ID de usuario, mostramos el perfil de ese usuario
            $usuarioActual = $user;
        } else {
            // Si no se ha proporcionado un ID, mostramos el perfil del usuario actual
            $usuarioActual = $this->getUser();
        }

        $miPerfil = $this->getUser() === $usuarioActual;

        return $this->render('profile/profile.html.twig', [
            'user' => $usuarioActual,
            'miPerfil' => $miPerfil
        ]);
    }

    #[Route('/post/delete/{id}', name: 'app_post_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function deletePost(Request $request, Post $post, EntityManagerInterface $em): Response
    {
        // Solo el dueño puede borrarlo
        if ($post->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $em->remove($post);
            $em->flush();
            $this->addFlash('success', 'Post eliminado correctamente.');
        }

        return $this->redirectToRoute('app_profile_posts');
    }
}