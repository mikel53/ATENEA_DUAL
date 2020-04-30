<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartesInteresadasRepository")
 */
class PartesInteresadas
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
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadGestion")
     */
    private $unidad_gestion;

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

    public function getUnidadGestion(): ?UnidadGestion
    {
        return $this->unidad_gestion;
    }

    public function setUnidadGestion(?UnidadGestion $unidad_gestion): self
    {
        $this->unidad_gestion = $unidad_gestion;

        return $this;
    }
}
