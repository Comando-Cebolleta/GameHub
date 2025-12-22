<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PersonajeHabilidad
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Personaje::class)]
    #[ORM\JoinColumn(name: 'personaje_id', referencedColumnName: 'id')]
    private ?Personaje $personaje = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Habilidad::class)]
    #[ORM\JoinColumn(name: 'habilidad_id', referencedColumnName: 'id')]
    private ?Habilidad $habilidad = null;

    #[ORM\Column]
    private ?int $nivel = null;

    public function getPersonaje(): ?Personaje
    {
        return $this->personaje;
    }

    public function setPersonaje(?Personaje $personaje): static
    {
        $this->personaje = $personaje;
        return $this;
    }

    public function getHabilidad(): ?Habilidad
    {
        return $this->habilidad;
    }

    public function setHabilidad(?Habilidad $habilidad): static
    {
        $this->habilidad = $habilidad;
        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(?int $nivel): static
    {
        $this->nivel = $nivel;
        return $this;
    }
}