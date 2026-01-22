<?php

namespace App\Entity;

use App\Repository\SetArtefactosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SetArtefactosRepository::class)]
class SetArtefactos
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    private ?string $efectos = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\Column]
    private ?string $juego = null;

    /**
     * @var Collection<int, ArtefactoPlantilla>
     */
    #[ORM\OneToMany(targetEntity: ArtefactoPlantilla::class, mappedBy: 'setArtefactos')]
    private Collection $artefactoPlantillas;

    public function __construct()
    {
        $this->artefactoPlantillas = new ArrayCollection();
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

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getJuego(): ?string
    {
        return $this->juego;
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
            $artefactoPlantilla->setSetArtefactos($this);
        }

        return $this;
    }

    public function removeArtefactoPlantilla(ArtefactoPlantilla $artefactoPlantilla): static
    {
        if ($this->artefactoPlantillas->removeElement($artefactoPlantilla)) {
            // set the owning side to null (unless already changed)
            if ($artefactoPlantilla->getSetArtefactos() === $this) {
                $artefactoPlantilla->setSetArtefactos(null);
            }
        }

        return $this;
    }
}
