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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;
    
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Arma $arma = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?PersonajePlantilla $personajePlantilla = null;

    #[ORM\OneToMany(mappedBy: 'personaje', targetEntity: EquipoPersonaje::class)]
    private Collection $equiposPersonaje;

    #[ORM\OneToMany(mappedBy: 'personaje', targetEntity: PersonajeHabilidad::class)]
    private Collection $personajeHabilidades;

    /**
     * @var Collection<int, Artefacto>
     */
    #[ORM\ManyToMany(targetEntity: Artefacto::class, inversedBy: 'personajes', cascade: ['persist'])]
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;
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

    public function getStatsCalculados(): ?array
    {
        // Obtenemos los datos base de la plantilla
        $plantilla = $this->getPersonajePlantilla();

        if (!$plantilla) {
            return [];
        }

        $base = $plantilla->getStatsBase() ?? [];
        $crecimiento = $plantilla->getStatsPorNivel() ?? [];
        $nivelActual = $this->getNivel();

        $statsFinales = [];

        // Recorremos las stats base
        
        // Este for es un poco raro. $nombreStat => $valorBase es para que 
        // $nombreStat sea el nombre del stat (ejemplo: "Ataque") y $valorBase sea el valor base de ese stat (ejemplo: 100)
        // por cada stat que encuentre en $base.
        // Básicamente recorre el JSON de stats base y lo convierte en variables que podemos usar dentro del bucle.
        foreach ($base as $nombreStat => $valorBase) {
            // Buscamos si este stat tiene crecimiento, si no, es 0
            $valorCrecimiento = $crecimiento[$nombreStat] ?? 0;

            // Restamos 1 porque a nivel 1 ya tienes la stat base, no se suma crecimiento.
            if ($nivelActual > 1) {
                $valorTotal = $valorBase + ($valorCrecimiento * ($nivelActual - 1));
            } else {
                $valorTotal = $valorBase;
            }

            // Guardamos el resultado (redondeado a 2 decimales para que quede bonito)
            $statsFinales[$nombreStat] = round($valorTotal, 2);
        }

        return $statsFinales;
    }
}
