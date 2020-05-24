<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactoresRiesgoRepository")
 */
class FactoresRiesgo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="date")
     */
    private $decha_baja;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Aspectos", inversedBy="factoresRiesgos")
     */
    private $FactoresRiesgo_Aspectos;

    public function __construct()
    {
        $this->FactoresRiesgo_Aspectos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fecha_alta;
    }

    public function setFechaAlta(\DateTimeInterface $fecha_alta): self
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    public function getDechaBaja(): ?\DateTimeInterface
    {
        return $this->decha_baja;
    }

    public function setDechaBaja(\DateTimeInterface $decha_baja): self
    {
        $this->decha_baja = $decha_baja;

        return $this;
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

    /**
     * @return Collection|Aspectos[]
     */
    public function getFactoresRiesgoAspectos(): Collection
    {
        return $this->FactoresRiesgo_Aspectos;
    }

    public function addFactoresRiesgoAspecto(Aspectos $factoresRiesgoAspecto): self
    {
        if (!$this->FactoresRiesgo_Aspectos->contains($factoresRiesgoAspecto)) {
            $this->FactoresRiesgo_Aspectos[] = $factoresRiesgoAspecto;
        }

        return $this;
    }

    public function removeFactoresRiesgoAspecto(Aspectos $factoresRiesgoAspecto): self
    {
        if ($this->FactoresRiesgo_Aspectos->contains($factoresRiesgoAspecto)) {
            $this->FactoresRiesgo_Aspectos->removeElement($factoresRiesgoAspecto);
        }

        return $this;
    }
}
