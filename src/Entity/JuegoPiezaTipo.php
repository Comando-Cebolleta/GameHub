<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class JuegoPiezaTipo
{
    #[ORM\Id]
    #[ORM\Column(type:"string")]
    private string $juego;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: PiezaTipo::class)]
    #[ORM\JoinColumn(nullable: false, onDelete:'CASCADE')]
    private PiezaTipo $piezaTipo;

    public function __construct(string $juego, PiezaTipo $piezaTipo)
    {
        $this->juego = $juego;
        $this->piezaTipo = $piezaTipo;
    }

    public function getJuego(): string
    {
        return $this->juego;
    }

    public function setJuego(string $juego): PiezaTipo
    {
        $this->juego = $juego;
        return $this;
    }

    public function getPiezaTipo(): PiezaTipo
    {
        return $this->piezaTipo;
    }

    public function setPiezaTipo( PiezaTipo $piezaTipo): PiezaTipo
    {
        $this->piezaTipo = $piezaTipo;
        return $this;
    }

}