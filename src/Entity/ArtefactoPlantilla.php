<?php

namespace App\Entity;

use App\Repository\ArtefactoPlantillaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtefactoPlantillaRepository::class)]
class ArtefactoPlantilla
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(length: 30)]
    private ?string $juego = null;

    #[ORM\ManyToOne(inversedBy: 'artefactoPlantillas')]
    private ?PiezaTipo $piezaTipo = null;

    #[ORM\ManyToOne(inversedBy: 'artefactoPlantillas')]
    private ?SetArtefactos $setArtefactos = null;

    /**
     * @var Collection<int, Artefacto>
     */
    #[ORM\OneToMany(targetEntity: Artefacto::class, mappedBy: 'artefactoPlantilla')]
    private Collection $artefactos;

    public function __construct()
    {
        $this->artefactos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getJuego(): ?string
    {
        return $this->juego;
    }

    public function setJuego(string $juego): static
    {
        $this->juego = $juego;

        return $this;
    }

    public function getPiezaTipo(): ?PiezaTipo
    {
        return $this->piezaTipo;
    }

    public function setPiezaTipo(?PiezaTipo $piezaTipo): static
    {
        $this->piezaTipo = $piezaTipo;

        return $this;
    }

    public function getSetArtefactos(): ?SetArtefactos
    {
        return $this->setArtefactos;
    }

    public function setSetArtefactos(?SetArtefactos $setArtefactos): static
    {
        $this->setArtefactos = $setArtefactos;

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
            $artefacto->setArtefactoPlantilla($this);
        }

        return $this;
    }

    public function removeArtefacto(Artefacto $artefacto): static
    {
        if ($this->artefactos->removeElement($artefacto)) {
            // set the owning side to null (unless already changed)
            if ($artefacto->getArtefactoPlantilla() === $this) {
                $artefacto->setArtefactoPlantilla(null);
            }
        }

        return $this;
    }
}
