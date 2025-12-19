<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'equipos')]
    private ?User $user = null;

    // Relación con la entidad intermedia EquipoPersonaje (M:N a través de la tabla intermedia)
    #[ORM\OneToMany(mappedBy: 'equipo', targetEntity: EquipoPersonaje::class)]
    private Collection $equiposPersonaje;

    public function __construct()
    {
        $this->equiposPersonaje = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

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
     * @return Collection<int, EquipoPersonaje>
     */
    public function getEquiposPersonaje(): Collection
    {
        return $this->equiposPersonaje;
    }

    public function addEquipoPersonaje(EquipoPersonaje $equipoPersonaje): static
    {
        if (!$this->equiposPersonaje->contains($equipoPersonaje)) {
            $this->equiposPersonaje->add($equipoPersonaje);
            $equipoPersonaje->setEquipo($this);
        }

        return $this;
    }

    public function removeEquipoPersonaje(EquipoPersonaje $equipoPersonaje): static
    {
        if ($this->equiposPersonaje->removeElement($equipoPersonaje)) {
            // Eliminar la relación en la entidad intermedia
            if ($equipoPersonaje->getEquipo() === $this) {
                $equipoPersonaje->setEquipo(null);
            }
        }

        return $this;
    }
}
