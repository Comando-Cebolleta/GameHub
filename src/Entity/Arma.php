<?php

namespace App\Entity;

use App\Repository\ArmaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArmaRepository::class)]
class Arma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nivel = null;

    #[ORM\ManyToOne(inversedBy: 'armas')]
    private ?ArmaPlantilla $armaPlantilla = null;

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

    public function getArmaPlantilla(): ?ArmaPlantilla
    {
        return $this->armaPlantilla;
    }

    public function setArmaPlantilla(?ArmaPlantilla $armaPlantilla): static
    {
        $this->armaPlantilla = $armaPlantilla;

        return $this;
    }

    public function getStatsCalculados(): array
    {
        // Obtenemos los datos base de la plantilla
        $plantilla = $this->getArmaPlantilla();
        
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
