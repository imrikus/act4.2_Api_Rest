<?php

namespace App\Entity;

use App\Repository\PreferenciaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PreferenciaRepository::class)
 */
class Preferencia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localitzacio;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipus(): ?string
    {
        return $this->tipus;
    }

    public function setTipus(string $tipus): self
    {
        $this->tipus = $tipus;

        return $this;
    }

    public function getLocalitzacio(): ?string
    {
        return $this->localitzacio;
    }

    public function setLocalitzacio(string $localitzacio): self
    {
        $this->localitzacio = $localitzacio;

        return $this;
    }
}
