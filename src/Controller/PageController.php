<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Post;
use App\Entity\Personaje;
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
    public function genshinBlog(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(Post::class)->findBy(
            ['juego' => 'genshin'],
            ['fechaPublicacion' => 'DESC']
        );

        // 1. Obtenemos todas las builds (Personajes)
        $todasLasBuilds = $em->getRepository(Personaje::class)->findAll();
        $buildsGenshin = [];

        // 2. Filtramos manualmente solo las de Genshin
        foreach ($todasLasBuilds as $build) {
            // Accedemos a la plantilla y comprobamos el juego
            if ($build->getPersonajePlantilla()->getJuego() === 'genshin') {
                $buildsGenshin[] = $build;
            }
        }

        return $this->render('page/genshin/blogGenshin.html.twig', [
            'posts' => $posts,
            'builds' => $buildsGenshin, // Enviamos el array filtrado
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

            return $this->redirectToRoute('genshin_post', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('page/nuevo_post.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PageController',
            "juego" => $juego
        ]);
    }

    #[Route('/genshin/blog/post/{id}', name: 'genshin_post')]
    public function genshinPost($id, Request $request, EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Post::class);
        $post = $repo->findOneByIdAndGame($id, "genshin");
        $juego = $post->getJuego();

        if (!$post) {
            throw $this->createNotFoundException('Ningún post existente con ese ID');
        }

        // Sección de Comentarios
        $comentario = new \App\Entity\Comentario();
        $formComentario = $this->createForm(\App\Form\ComentarioType::class, $comentario);
        $formComentario->handleRequest($request);

        if ($formComentario->isSubmitted() && $formComentario->isValid() && $this->getUser()) {
            $comentario->setUser($this->getUser());
            $comentario->setPost($post);
            $comentario->setFechaPublicacion(new \DateTime());

            $em->persist($comentario);
            $em->flush();

            return $this->redirectToRoute('genshin_post', ['id' => $post->getId()]);
        }

        return $this->render('page/single_post.html.twig', [
            "post" => $post,
            "juego" => $juego,
            "commentForm" => $formComentario->createView()
        ]);
    }

    #[Route('/genshin/builds', name: 'genshin_builds')]
    public function genshinBuilds(): Response
    {
        return $this->render('page/genshin/buildsGenshin.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/hsr/blog', name: 'hsr_blog')]
    public function hsrBlog(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(Post::class)->findBy(
            ['juego' => 'hsr'],
            ['fechaPublicacion' => 'DESC']
        );

        // 1. Obtenemos todas las builds (Personajes)
        $todasLasBuilds = $em->getRepository(Personaje::class)->findAll();
        $buildsHonkai = [];

        // 2. Filtramos manualmente solo las de Honkai
        foreach ($todasLasBuilds as $build) {
            // Accedemos a la plantilla y comprobamos el juego
            if ($build->getPersonajePlantilla()->getJuego() === 'hsr') {
                $buildsHonkai[] = $build;
            }
        }

        return $this->render('page/hsr/blogHonkai.html.twig', [
            'posts' => $posts,
            'builds' => $buildsHonkai, // Enviamos el array filtrado
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

            return $this->redirectToRoute('hsr_post', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('page/nuevo_post.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PageController',
            "juego" => $juego
        ]);
    }

    #[Route('/hsr/blog/post/{id}', name: 'hsr_post')]
    public function hsrPost($id, Request $request, EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Post::class);
        $post = $repo->findOneByIdAndGame($id, "hsr");
        $juego = $post->getJuego();

        if (!$post) {
            throw $this->createNotFoundException('Ningún post existente con ese ID');
        }

        // Sección de Comentarios
        $comentario = new \App\Entity\Comentario();
        $formComentario = $this->createForm(\App\Form\ComentarioType::class, $comentario);
        $formComentario->handleRequest($request);

        if ($formComentario->isSubmitted() && $formComentario->isValid() && $this->getUser()) {
            $comentario->setUser($this->getUser());
            $comentario->setPost($post);
            $comentario->setFechaPublicacion(new \DateTime());

            $em->persist($comentario);
            $em->flush();

            return $this->redirectToRoute('hsr_post', ['id' => $post->getId()]);
        }

        return $this->render('page/single_post.html.twig', [
            "post" => $post,
            "juego" => $juego,
            "commentForm" => $formComentario->createView()
        ]);
    }

    #[Route('/hsr/builds', name: 'hsr_builds')]
    public function hsrBuilds(): Response
    {
        return $this->render('page/hsr/buildsHonkai.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
