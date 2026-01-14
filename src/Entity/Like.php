<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'likes')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'likes')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id')]
    private ?Post $post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }
}
