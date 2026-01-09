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
}
