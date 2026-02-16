<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LikeController extends AbstractController
{
    #[Route('/post/{id}/like', name: 'app_post_toggle_like', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function toggleLike(Post $post, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        $likeRepo = $em->getRepository(Like::class);
        
        // Buscar si ya existe el like
        $existingLike = $likeRepo->findOneBy([
            'user' => $user,
            'post' => $post
        ]);

        if ($existingLike) {
            $em->remove($existingLike);
            $liked = false;
        } else {
            $like = new Like();
            $like->setUser($user);
            $like->setPost($post);
            $em->persist($like);
            $liked = true;
        }

        $em->flush();

        return new JsonResponse([
            'liked' => $liked,
            'likesCount' => $post->getLikes()->count()
        ]);
    }
}
