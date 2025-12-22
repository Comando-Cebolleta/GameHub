<?php

namespace App\Entity;

use App\Repository\PersonajePlantillaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonajePlantillaRepository::class)]
class PersonajePlantilla
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $juego = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(nullable: true)]
    private ?array $statsBase = null;

    #[ORM\Column(nullable: true)]
    private ?array $statsPorNivel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'personajePlantilla')]
    private Collection $personajes;

    /**
     * @var Collection<int, Dupe>
     */
    #[ORM\OneToMany(targetEntity: Dupe::class, mappedBy: 'personajePlantilla')]
    private Collection $dupes;

    /**
     * @var Collection<int, Habilidad>
     */
    #[ORM\OneToMany(targetEntity: Habilidad::class, mappedBy: 'personajePlantilla')]
    private Collection $habilidades;

    public function __construct()
    {
        $this->personajes = new ArrayCollection();
        $this->dupes = new ArrayCollection();
        $this->habilidades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

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

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): static
    {
        $this->imagen = $imagen;

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
            $personaje->setPersonajePlantilla($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getPersonajePlantilla() === $this) {
                $personaje->setPersonajePlantilla(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dupe>
     */
    public function getDupes(): Collection
    {
        return $this->dupes;
    }

    public function addDupe(Dupe $dupe): static
    {
        if (!$this->dupes->contains($dupe)) {
            $this->dupes->add($dupe);
            $dupe->setPersonajePlantilla($this);
        }

        return $this;
    }

    public function removeDupe(Dupe $dupe): static
    {
        if ($this->dupes->removeElement($dupe)) {
            // set the owning side to null (unless already changed)
            if ($dupe->getPersonajePlantilla() === $this) {
                $dupe->setPersonajePlantilla(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Habilidad>
     */
    public function getHabilidades(): Collection
    {
        return $this->habilidades;
    }

    public function addHabilidad(Habilidad $habilidad): static
    {
        if (!$this->habilidades->contains($habilidad)) {
            $this->habilidades->add($habilidad);
            $habilidad->setPersonajePlantilla($this);
        }

        return $this;
    }

    public function removeHabilidad(Habilidad $habilidad): static
    {
        if ($this->habilidades->removeElement($habilidad)) {
            // set the owning side to null (unless already changed)
            if ($habilidad->getPersonajePlantilla() === $this) {
                $habilidad->setPersonajePlantilla(null);
            }
        }

        return $this;
    }
}
