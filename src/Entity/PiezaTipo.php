<?php

namespace App\Entity;

use App\Repository\PiezaTipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiezaTipoRepository::class)]
class PiezaTipo
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codigo = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null; // Nombre para mostrar en front

    /**
     * @var Collection<int, ArtefactoPlantilla>
     */
    #[ORM\OneToMany(targetEntity: ArtefactoPlantilla::class, mappedBy: 'piezaTipo')]
    private Collection $artefactoPlantillas;

    public function __construct()
    {
        $this->artefactoPlantillas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
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

    /**
     * @return Collection<int, ArtefactoPlantilla>
     */
    public function getArtefactoPlantillas(): Collection
    {
        return $this->artefactoPlantillas;
    }

    public function addArtefactoPlantilla(ArtefactoPlantilla $artefactoPlantilla): static
    {
        if (!$this->artefactoPlantillas->contains($artefactoPlantilla)) {
            $this->artefactoPlantillas->add($artefactoPlantilla);
            $artefactoPlantilla->setPiezaTipo($this);
        }

        return $this;
    }

    public function removeArtefactoPlantilla(ArtefactoPlantilla $artefactoPlantilla): static
    {
        if ($this->artefactoPlantillas->removeElement($artefactoPlantilla)) {
            // set the owning side to null (unless already changed)
            if ($artefactoPlantilla->getPiezaTipo() === $this) {
                $artefactoPlantilla->setPiezaTipo(null);
            }
        }

        return $this;
    }
}
