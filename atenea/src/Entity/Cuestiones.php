<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuestionesRepository")
 */
class Cuestiones
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ineterno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subtipos")
     */
    private $subtipos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIneterno(): ?bool
    {
        return $this->ineterno;
    }

    public function setIneterno(bool $ineterno): self
    {
        $this->ineterno = $ineterno;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getSubtipos(): ?Subtipos
    {
        return $this->subtipos;
    }

    public function setSubtipos(?Subtipos $subtipos): self
    {
        $this->subtipos = $subtipos;

        return $this;
    }
}
