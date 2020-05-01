<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnidadGestionRepository")
 */
class UnidadGestion
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
    private $fecha_baja;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coo_em_empl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contratos")
     */
    private $contratos;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cuestiones", mappedBy="cuestion_unidadGestion")
     */
    private $cuestiones;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadGestion")
     */
    private $unidadGestion;

    public function __construct()
    {
        $this->unidad_gestion_usuarios = new ArrayCollection();
        $this->cuestiones = new ArrayCollection();
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

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fecha_baja;
    }

    public function setFechaBaja(\DateTimeInterface $fecha_baja): self
    {
        $this->fecha_baja = $fecha_baja;

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

    public function getCooEmEmpl(): ?string
    {
        return $this->coo_em_empl;
    }

    public function setCooEmEmpl(string $coo_em_empl): self
    {
        $this->coo_em_empl = $coo_em_empl;

        return $this;
    }

    public function getContratos(): ?Contratos
    {
        return $this->contratos;
    }

    public function setContratos(?Contratos $contratos): self
    {
        $this->contratos = $contratos;

        return $this;
    }

  

    /**
     * @return Collection|Cuestiones[]
     */
    public function getCuestiones(): Collection
    {
        return $this->cuestiones;
    }

    public function addCuestione(Cuestiones $cuestione): self
    {
        if (!$this->cuestiones->contains($cuestione)) {
            $this->cuestiones[] = $cuestione;
            $cuestione->addCuestionUnidadGestion($this);
        }

        return $this;
    }

    public function removeCuestione(Cuestiones $cuestione): self
    {
        if ($this->cuestiones->contains($cuestione)) {
            $this->cuestiones->removeElement($cuestione);
            $cuestione->removeCuestionUnidadGestion($this);
        }

        return $this;
    }

    public function getUnidadGestion(): ?self
    {
        return $this->unidadGestion;
    }

    public function setUnidadGestion(?self $unidadGestion): self
    {
        $this->unidadGestion = $unidadGestion;

        return $this;
    }
}
