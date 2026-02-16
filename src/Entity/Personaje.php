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

    #[ORM\OneToMany(mappedBy: 'personaje', targetEntity: PersonajeHabilidad::class, cascade: ['persist', 'remove'])]
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

    // Esta función es la que se encarga de calcular los stats finales del personaje, combinando su plantilla, arma y artefactos 💀
    public function getStatsCalculados(): ?array
    {
        // Obtener Plantillas y Datos
        $plantilla = $this->getPersonajePlantilla();
        if (!$plantilla) return [];

        $nivelActual = $this->getNivel();
        
        // Inicializamos los acumuladores
        // Stats base planos (Personaje + Arma)
        $statsBase = ['HP' => 0.0, 'ATK' => 0.0, 'DEF' => 0.0];
        
        // Stats porcentuales (Personaje + Arma + Artefactos)
        $statsPorcentuales = ['HP' => 0.0, 'ATK' => 0.0, 'DEF' => 0.0];
        
        // Stats planos extra que no se multiplican (ej: substat de artefacto de ATK plano, o stats planos del arma)
        $statsPlanosExtra = ['HP' => 0.0, 'ATK' => 0.0, 'DEF' => 0.0];
        
        // otrosStats: Crit, EM, Bonos de Daño, etc.
        $otrosStats = [];

        // Calcular base del personaje
        $basePj = $plantilla->getStatsBase() ?? [];
        $crecimientoPj = $plantilla->getStatsPorNivel() ?? [];

        foreach ($basePj as $nombre => $valorBase) {
            $crecimiento = $crecimientoPj[$nombre] ?? 0;
            $valorTotal = ($nivelActual > 1) 
                ? $valorBase + ($crecimiento * ($nivelActual - 1)) 
                : $valorBase;

            // Si es HP, ATK o DEF, va al acumulador Base. Si no (ej: Velocidad, Crit ascensión), va a Otros
            if (isset($statsBase[$nombre])) {
                $statsBase[$nombre] += $valorTotal;
            } else {
                // Si el PJ escala con % (ej: bono daño), lo sumamos directo
                if (isset($otrosStats[$nombre])) {
                    $otrosStats[$nombre] += $valorTotal;
                } else {
                    $otrosStats[$nombre] = $valorTotal;
                }
            }
        }

        // Calcular arma
        // Asumimos que el arma da Stats Base (ATK) y quizás un Substat (%)
        if ($this->getArma()) {
            $statsArma = $this->getArma()->getStatsCalculados() ?? [];
            
            foreach ($statsArma as $nombre => $valor) {
                if (isset($statsBase[$nombre])) {
                    // Si el arma da ATK plano, se suma a la BASE
                    $statsBase[$nombre] += $valor;
                } elseif (str_contains($nombre, '%')) {
                    // Si el arma da ATK%, limpiamos el nombre y sumamos al %
                    $nombreLimpio = str_replace('%', '', $nombre);
                    if (isset($statsPorcentuales[$nombreLimpio])) {
                        $statsPorcentuales[$nombreLimpio] += $valor; // El valor ya viene como 0.x
                    } else {
                        // Caso de Bono Daño%, Prob Crit%, etc.
                        $otrosStats[$nombre] = ($otrosStats[$nombre] ?? 0) + $valor;
                    }
                } else {
                    // Otros stats planos del arma (ej: Maestria)
                    $otrosStats[$nombre] = ($otrosStats[$nombre] ?? 0) + $valor;
                }
            }
        }

        // Calcular artefactos
        $artefactos = $this->getArtefactos();
        
        // Función auxiliar para procesar un stat de artefacto
        $procesarStatArtefacto = function($nombre, $valor) use (&$statsPorcentuales, &$statsPlanosExtra, &$otrosStats) {
            // Caso 1: Es porcentual de los básicos (ATK%, DEF%, HP%)
            if (str_ends_with($nombre, '%')) {
                $nombreLimpio = str_replace('%', '', $nombre);
                if (isset($statsPorcentuales[$nombreLimpio])) {
                    $statsPorcentuales[$nombreLimpio] += $valor;
                    return;
                }
            }
            
            // Caso 2: Es plano de los básicos (ATK, DEF, HP) -> Va a PlanosExtra (no se multiplica)
            if (isset($statsPlanosExtra[$nombre])) {
                $statsPlanosExtra[$nombre] += $valor;
                return;
            }

            // Caso 3: Cualquier otro (Crit, EM, Bonos daño, o % que no sean los básicos)
            if (isset($otrosStats[$nombre])) {
                $otrosStats[$nombre] += $valor;
            } else {
                $otrosStats[$nombre] = $valor;
            }
        };

        foreach ($artefactos as $artefacto) {
            $stats = $artefacto->getEstadisticas() ?? [];
            
            // Main Stat
            if (isset($stats['main_stat'])) {
                $procesarStatArtefacto($stats['main_stat']['name'], $stats['main_stat']['value']);
            }
            
            // Sub Stats
            if (isset($stats['sub_stats']) && is_array($stats['sub_stats'])) {
                foreach ($stats['sub_stats'] as $subStat) {
                    $procesarStatArtefacto($subStat['name'], $subStat['value']);
                }
            }
        }

        // Sumar todo
        $statsFinales = $otrosStats;

        // Calculamos HP, ATK y DEF aplicando la fórmula
        foreach ($statsBase as $statName => $valorBase) {
            $multiplicador = 1 + ($statsPorcentuales[$statName] ?? 0);
            $planoExtra = $statsPlanosExtra[$statName] ?? 0;
            
            // Fórmula: (Base * (1 + %)) + PlanoExtra
            $total = ($valorBase * $multiplicador) + $planoExtra;
            
            // Guardamos redondeado (sin decimales para stats planos grandes)
            $statsFinales[$statName] = round($total);
        }

        // Ordenar para que HP, ATK, DEF salgan primero
        $ordenDeseado = ['HP', 'ATK', 'DEF'];
        $arrayOrdenado = [];
        
        foreach ($ordenDeseado as $key) {
            if (isset($statsFinales[$key])) {
                $arrayOrdenado[$key] = $statsFinales[$key];
                unset($statsFinales[$key]);
            }
        }
        // Añadimos el resto
        $arrayOrdenado = array_merge($arrayOrdenado, $statsFinales);

        return $arrayOrdenado;
    }
}