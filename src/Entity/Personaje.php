<?php

namespace App\Entity;

use App\Repository\PersonajeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonajeRepository::class)]
class Personaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nivel = null;

    #[ORM\Column]
    private ?int $dupeNum = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?User $user = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Arma $arma = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?PersonajePlantilla $personajePlantilla = null;

    // Relación con la entidad intermedia EquipoPersonaje (M:N a través de la tabla intermedia)
    #[ORM\OneToMany(mappedBy: 'personaje', targetEntity: EquipoPersonaje::class)]
    private Collection $equiposPersonaje;

    #[ORM\OneToMany(mappedBy: 'personaje', targetEntity: PersonajeHabilidad::class)]
    private Collection $personajeHabilidades;

    /**
     * @var Collection<int, Artefacto>
     */
    #[ORM\ManyToMany(targetEntity: Artefacto::class, inversedBy: 'personajes')]
    private Collection $artefactos;

    public function __construct()
    {
        $this->equiposPersonaje = new ArrayCollection();
        $this->personajeHabilidades = new ArrayCollection();
        $this->artefactos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(int $nivel): static
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getDupeNum(): ?int
    {
        return $this->dupeNum;
    }

    public function setDupeNum(int $dupeNum): static
    {
        $this->dupeNum = $dupeNum;

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

    public function getArma(): ?Arma
    {
        return $this->arma;
    }

    public function setArma(?Arma $arma): static
    {
        $this->arma = $arma;

        return $this;
    }

    public function getPersonajePlantilla(): ?PersonajePlantilla
    {
        return $this->personajePlantilla;
    }

    public function setPersonajePlantilla(?PersonajePlantilla $personajePlantilla): static
    {
        $this->personajePlantilla = $personajePlantilla;

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
            $equipoPersonaje->setPersonaje($this);
        }

        return $this;
    }

    public function removeEquipoPersonaje(EquipoPersonaje $equipoPersonaje): static
    {
        if ($this->equiposPersonaje->removeElement($equipoPersonaje)) {
            // Eliminar la relación en la entidad intermedia
            if ($equipoPersonaje->getPersonaje() === $this) {
                $equipoPersonaje->setPersonaje(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PersonajeHabilidad>
     */
    public function getPersonajeHabilidades(): Collection
    {
        return $this->personajeHabilidades;
    }

    public function addPersonajeHabilidad(PersonajeHabilidad $personajeHabilidad): static
    {
        if (!$this->personajeHabilidades->contains($personajeHabilidad)) {
            $this->personajeHabilidades->add($personajeHabilidad);
            $personajeHabilidad->setPersonaje($this);
        }

        return $this;
    }

    public function removePersonajeHabilidad(PersonajeHabilidad $personajeHabilidad): static
    {
        if ($this->personajeHabilidades->removeElement($personajeHabilidad)) {
            // Eliminar la relación en la entidad intermedia
            if ($personajeHabilidad->getPersonaje() === $this) {
                $personajeHabilidad->setPersonaje(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Artefacto>
     */
    public function getArtefactos(): Collection
    {
        return $this->artefactos;
    }

    public function addArtefacto(Artefacto $artefacto): static
    {
        if (!$this->artefactos->contains($artefacto)) {
            $this->artefactos->add($artefacto);
        }

        return $this;
    }

    public function removeArtefacto(Artefacto $artefacto): static
    {
        $this->artefactos->removeElement($artefacto);

        return $this;
    }
}
