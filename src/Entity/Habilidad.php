<?php

namespace App\Entity;

use App\Repository\HabilidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HabilidadRepository::class)]
class Habilidad
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 1024)]
    private ?string $efectos = null;

    #[ORM\ManyToOne(inversedBy: 'habilidades')]
    #[ORM\JoinColumn(name: 'personaje_plantilla_id', nullable: true)]
    private ?PersonajePlantilla $personajePlantilla = null;

    #[ORM\OneToMany(mappedBy: 'habilidad', targetEntity: PersonajeHabilidad::class)]
    private Collection $personajeHabilidades;

    public function __construct()
    {
        $this->personajeHabilidades = new ArrayCollection();
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

    public function getEfectos(): ?string
    {
        return $this->efectos;
    }

    public function setEfectos(string $efectos): static
    {
        $this->efectos = $efectos;

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
            $personajeHabilidad->setHabilidad($this);
        }

        return $this;
    }

    public function removePersonajeHabilidad(PersonajeHabilidad $personajeHabilidad): static
    {
        if ($this->personajeHabilidades->removeElement($personajeHabilidad)) {

            if ($personajeHabilidad->getHabilidad() === $this) {
                $personajeHabilidad->setHabilidad(null);
            }
        }

        return $this;
    }
}
