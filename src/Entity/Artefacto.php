<?php

namespace App\Entity;

use App\Repository\ArtefactoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtefactoRepository::class)]
class Artefacto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $estadisticas = [];

    #[ORM\ManyToOne(inversedBy: 'artefactos')]
    private ?ArtefactoPlantilla $artefactoPlantilla = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\ManyToMany(targetEntity: Personaje::class, mappedBy: 'artefactos')]
    private Collection $personajes;

    public function __construct()
    {
        $this->personajes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstadisticas(): array
    {
        return $this->estadisticas;
    }

    public function setEstadisticas(array $estadisticas): static
    {
        $this->estadisticas = $estadisticas;

        return $this;
    }

    public function getArtefactoPlantilla(): ?ArtefactoPlantilla
    {
        return $this->artefactoPlantilla;
    }

    public function setArtefactoPlantilla(?ArtefactoPlantilla $artefactoPlantilla): static
    {
        $this->artefactoPlantilla = $artefactoPlantilla;

        return $this;
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->addArtefacto($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            $personaje->removeArtefacto($this);
        }

        return $this;
    }
}
