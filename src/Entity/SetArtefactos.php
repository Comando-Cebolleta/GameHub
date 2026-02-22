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

    #[ORM\Column(length: 4096)]
    private ?array $efectos = null;

    #[ORM\Column(length: 255, nullable: true)]
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

    public function getEfectos(): ?array
    {
        return $this->efectos;
    }

    public function setEfectos(array $efectos): static
    {
        $this->efectos = $efectos;

        return $this;
    }

    // Convierte el array asociativo {"2":"...","4":"..."} a una lista
    // de entradas para usar en CollectionField: [ ['piezas'=>'2','descripcion'=>'...'], ... ]
    public function getEfectosForm(): array
    {
        $result = [];
        if (empty($this->efectos) || !is_array($this->efectos)) {
            return $result;
        }

        foreach ($this->efectos as $piezas => $descripcion) {
            $result[] = ['piezas' => (string)$piezas, 'descripcion' => $descripcion];
        }

        return $result;
    }

    // Recibe una lista de entradas (piezas, descripcion) y la guarda como array asociativo
    public function setEfectosForm(array $lista): static
    {
        $assoc = [];
        foreach ($lista as $entry) {
            if (!is_array($entry)) continue;
            $piezas = isset($entry['piezas']) ? (string)$entry['piezas'] : null;
            $descripcion = $entry['descripcion'] ?? '';
            if ($piezas !== null && $piezas !== '') {
                $assoc[$piezas] = $descripcion;
            }
        }

        $this->efectos = $assoc;
        return $this;
    }

    // Esto es para que el JSON devuelve el efecto de 2 piezas o el de 2 y 4 dependiendo.
    public function getEfectosSum(int $num): ?array
    {
        $resultado = [];

        if ($num >= 2 && isset($this->efectos['2'])) {
            $resultado['2'] = $this->efectos['2'];
        }

        if ($num >= 4 && isset($this->efectos['4'])) {
            $resultado['4'] = $this->efectos['4'];
        }

        return $resultado;
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
            
            if ($artefactoPlantilla->getSetArtefactos() === $this) {
                $artefactoPlantilla->setSetArtefactos(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre;
    }
}
