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

    #[ORM\Column]
    private ?\DateTime $fechaPublicacion = null;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id')]
    private ?Post $post = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    public function __construct()
    {
        $this->fechaPublicacion = new \DateTime();
    }

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

    public function getFechaPublicacion(): ?\DateTime
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(\DateTime $fechaPublicacion): static
    {
        $this->fechaPublicacion = $fechaPublicacion;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
