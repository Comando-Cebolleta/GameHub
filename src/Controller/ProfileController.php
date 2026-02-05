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
    #[Route('/', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function perfil(): Response
    {
        return $this->render('profile/profile.html.twig');
    }

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
}
