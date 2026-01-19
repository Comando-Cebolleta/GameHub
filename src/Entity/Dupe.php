<?php

namespace App\Entity;

use App\Repository\DupeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DupeRepository::class)]
class Dupe
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $efectos = null;

    #[ORM\ManyToOne(inversedBy: 'dupes')]
    private ?PersonajePlantilla $personajePlantilla = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

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
}
