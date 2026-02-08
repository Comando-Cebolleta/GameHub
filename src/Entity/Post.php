<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $cuerpo = null;

    #[ORM\Column]
    private ?\DateTime $fechaPublicacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $visitas = 0;

    #[ORM\Column(nullable: false)]
    private ?string $juego = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private ?User $user = null;

    /**
     * @var Collection<int, Comentario>
     */
    #[ORM\OneToMany(targetEntity: Comentario::class, mappedBy: 'post')]
    private Collection $comentarios;

    /**
     * @var Collection<int, Like>
     */
    #[ORM\OneToMany(targetEntity: Like::class, mappedBy: 'post')]
    private Collection $likes;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->fechaPublicacion = new \DateTime();
        $this->likes = new ArrayCollection();
        $this->visitas = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
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

    public function getVisitas(): ?int
    {
        return $this->visitas;
    }

    public function setVisitas(?int $visitas): static
    {
        $this->visitas = $visitas;

        return $this;
    }

    public function getJuego(): ?string
    {
        return $this->juego;
    }

    public function setJuego(?string $juego): static
    {
        $this->juego = $juego;

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

    /**
     * @return Collection<int, Comentario>
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): static
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios->add($comentario);
            $comentario->setPostId($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): static
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getPostId() === $this) {
                $comentario->setPostId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): static
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setPost($this);
        }

        return $this;
    }

    public function removeLike(Like $like): static
    {
        if ($this->likes->removeElement($like)) {
            
            if ($like->getPost() === $this) {
                $like->setPost(null);
            }
        }

        return $this;
    }
}
