<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AspectosRepository")
 */
class Aspectos
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
    private $favorable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $interno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cuestiones", inversedBy="aspectos")
     */
    private $Aspecto_Cuestiones;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FactoresRiesgo", mappedBy="FactoresRiesgo_Aspectos")
     */
    private $factoresRiesgos;

    public function __construct()
    {
        $this->Aspecto_Cuestiones = new ArrayCollection();
        $this->factoresRiesgos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFavorable(): ?bool
    {
        return $this->favorable;
    }

    public function setFavorable(bool $favorable): self
    {
        $this->favorable = $favorable;

        return $this;
    }

    public function getInterno(): ?bool
    {
        return $this->interno;
    }

    public function setInterno(bool $interno): self
    {
        $this->interno = $interno;

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

    /**
     * @return Collection|Cuestiones[]
     */
    public function getAspectoCuestiones(): Collection
    {
        return $this->Aspecto_Cuestiones;
    }

    public function addAspectoCuestione(Cuestiones $aspectoCuestione): self
    {
        if (!$this->Aspecto_Cuestiones->contains($aspectoCuestione)) {
            $this->Aspecto_Cuestiones[] = $aspectoCuestione;
        }

        return $this;
    }

    public function removeAspectoCuestione(Cuestiones $aspectoCuestione): self
    {
        if ($this->Aspecto_Cuestiones->contains($aspectoCuestione)) {
            $this->Aspecto_Cuestiones->removeElement($aspectoCuestione);
        }

        return $this;
    }

    /**
     * @return Collection|FactoresRiesgo[]
     */
    public function getFactoresRiesgos(): Collection
    {
        return $this->factoresRiesgos;
    }

    public function addFactoresRiesgo(FactoresRiesgo $factoresRiesgo): self
    {
        if (!$this->factoresRiesgos->contains($factoresRiesgo)) {
            $this->factoresRiesgos[] = $factoresRiesgo;
            $factoresRiesgo->addFactoresRiesgoAspecto($this);
        }

        return $this;
    }

    public function removeFactoresRiesgo(FactoresRiesgo $factoresRiesgo): self
    {
        if ($this->factoresRiesgos->contains($factoresRiesgo)) {
            $this->factoresRiesgos->removeElement($factoresRiesgo);
            $factoresRiesgo->removeFactoresRiesgoAspecto($this);
        }

        return $this;
    }
}
