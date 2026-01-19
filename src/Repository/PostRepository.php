<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findOneByIdAndGame(int $id, string $game): ?Post
    {
        return $this->createQueryBuilder("i")
            ->where("i.id = :id")
            ->andWhere("i.juego = :game")
            ->setParameter("id", $id)
            ->setParameter("game", $game)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
