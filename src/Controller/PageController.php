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

    #[Route('/genshin/blog/nuevo_post', name: 'genshin_nuevo_post')]
    public function genshinNuevoPost(Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();
        $post->setJuego($request->query->get('juego', 'genshin'));
        $post->setUser($this->getUser());
        $post->setVisitas(0);

        //Por seguridad
        $juego = $post->getJuego();
        if ($juego !== 'genshin') {
            $post->setJuego('genshin');
        }

        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('page/nuevo_post.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PageController',
        ]);
    }

//    #[Route('/genshin/blog/post/{id}', name: 'genshin_post')]
//    public function genshinPost(Request $request, EntityManagerInterface $em): Response
//    {
//        return $this->render('page/nuevo_post.html.twig', [
//            'form' => $form->createView(),
//            'controller_name' => 'PageController',
//        ]);
//    }

    #[Route('/hsr/blog', name: 'hsr_blog')]
    public function hsrBlog(): Response
    {
        return $this->render('page/hsr/blogHonkai.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/hsr/blog/nuevo_post', name: 'hsr_nuevo_post')]
    public function hsrNuevoPost(Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();
        $post->setJuego($request->query->get('juego', 'hsr'));
        $post->setUser($this->getUser());
        $post->setVisitas(0);

        //Por seguridad
        $juego = $post->getJuego();
        if ($juego !== 'hsr') {
            $post->setJuego('hsr');
        }

        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('page/nuevo_post.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PageController',
        ]);
    }
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function perfil(): Response
    {
        // Asegúrate de que tu archivo esté en: templates/profile/profile.html.twig
        return $this->render('profile/profile.html.twig');
    }
}
