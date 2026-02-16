<?php

namespace App\Entity;

use App\Repository\ArmaPlantillaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArmaPlantillaRepository::class)]
class ArmaPlantilla
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(length: 30)]
    private ?string $juego = null;

    #[ORM\Column(nullable: true)]
    private ?array $statsBase = null;

    #[ORM\Column(nullable: true)]
    private ?array $statsPorNivel = null;

    #[ORM\Column(length: 4096, nullable: true)]
    private ?string $pasiva = null;

    #[ORM\Column(nullable: true)]
    private ?string $tipo;

    /**
     * @var Collection<int, Arma>
     */
    #[ORM\OneToMany(targetEntity: Arma::class, mappedBy: 'armaPlantilla')]
    private Collection $armas;

    public function __construct()
    {
        $this->armas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getStatsBase(): ?array
    {
        return $this->statsBase;
    }

    public function setStatsBase(?array $statsBase): static
    {
        $this->statsBase = $statsBase;

        return $this;
    }

    public function getStatsPorNivel(): ?array
    {
        return $this->statsPorNivel;
    }

    public function setStatsPorNivel(?array $statsPorNivel): static
    {
        $this->statsPorNivel = $statsPorNivel;

        return $this;
    }

    public function getPasiva(): ?string
    {
        return $this->pasiva;
    }

    public function setPasiva(?string $pasiva): static
    {
        $this->pasiva = $pasiva;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Arma>
     */
    public function getArmas(): Collection
    {
        return $this->armas;
    }

    public function addArma(Arma $arma): static
    {
        if (!$this->armas->contains($arma)) {
            $this->armas->add($arma);
            $arma->setArmaPlantilla($this);
        }

        return $this;
    }

    public function removeArma(Arma $arma): static
    {
        if ($this->armas->removeElement($arma)) {
            // set the owning side to null (unless already changed)
            if ($arma->getArmaPlantilla() === $this) {
                $arma->setArmaPlantilla(null);
            }
        }

        return $this;
    }
}
