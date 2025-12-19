<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EquipoPersonaje
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Personaje::class)]
    #[ORM\JoinColumn(name: 'personaje_id', referencedColumnName: 'id')]
    private ?Personaje $personaje = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Equipo::class)]
    #[ORM\JoinColumn(name: 'equipo_id', referencedColumnName: 'id')]
    private ?Equipo $equipo = null;

    #[ORM\Column(length: 255)]
    private ?int $posicion = null;

    public function getPersonaje(): ?Personaje
    {
        return $this->personaje;
    }

    public function setPersonaje(?Personaje $personaje): static
    {
        $this->personaje = $personaje;
        return $this;
    }

    public function getEquipo(): ?Equipo
    {
        return $this->equipo;
    }

    public function setEquipo(?Equipo $equipo): static
    {
        $this->equipo = $equipo;
        return $this;
    }

    public function getPosicion(): ?int
    {
        return $this->posicion;
    }

    public function setPosicion(int $posicion): static
    {
        $this->posicion = $posicion;
        return $this;
    }
}
