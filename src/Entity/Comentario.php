<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4096)]
    private ?string $cuerpo = null;

    #[ORM\Column(nullable: true)]
    private ?int $likes = null;

    #[ORM\Column]
    private ?\DateTime $fechaPublicacion = null;

    // Cambié 'postId' a 'post' para seguir las convenciones de nomenclatura.
    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id')]
    private ?Post $post = null;

    // Cambié 'userId' a 'user' para mantener consistencia en la nomenclatura.
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCuerpo(): ?string
    {
        return $this->cuerpo;
    }

    public function setCuerpo(string $cuerpo): static
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTime
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(\DateTime $fechaPublicacion): static
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    // Cambié el nombre del método de 'getPostId' a 'getPost' para hacer el nombre más claro.
    public function getPost(): ?Post
    {
        return $this->post;
    }

    // Cambié el nombre del método de 'setPostId' a 'setPost' para hacerlo coherente con la propiedad.
    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    // Cambié el nombre del método de 'getUserId' a 'getUser' para hacerlo más coherente con la propiedad.
    public function getUser(): ?User
    {
        return $this->user;
    }

    // Cambié el nombre del método de 'setUserId' a 'setUser' para hacer la relación coherente con la propiedad.
    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
