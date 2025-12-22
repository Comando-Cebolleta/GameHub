<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/genshin/blog', name: 'genshin_blog')]
    public function genshinBlog(): Response
    {
        return $this->render('page/genshin/blogGenshin.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/hsr/blog', name: 'hsr_blog')]
    public function hsrBlog(): Response
    {
        return $this->render('page/hsr/blogHonkai.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
