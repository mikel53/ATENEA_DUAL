<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpectativaRepository")
 */
class Expectativa
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
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PartesInteresadas")
     */
    private $partes_interesadas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPartesInteresadas(): ?PartesInteresadas
    {
        return $this->partes_interesadas;
    }

    public function setPartesInteresadas(?PartesInteresadas $partes_interesadas): self
    {
        $this->partes_interesadas = $partes_interesadas;

        return $this;
    }
}
