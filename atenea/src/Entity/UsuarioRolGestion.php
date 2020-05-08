<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRolGestionRepository")
 */
class UsuarioRolGestion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Permisos")
     */
    private $permiso;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadGestion")
     */
    private $unidadGestion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuarios", inversedBy="usuarioRolGestions")
     */
    private $usuarios;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPermiso(): ?Permisos
    {
        return $this->permiso;
    }

    public function setPermiso(?Permisos $permiso): self
    {
        $this->permiso = $permiso;

        return $this;
    }

    public function getUnidadGestion(): ?UnidadGestion
    {
        return $this->unidadGestion;
    }

    public function setUnidadGestion(?UnidadGestion $unidadGestion): self
    {
        $this->unidadGestion = $unidadGestion;

        return $this;
    }

    public function getUsuarios(): ?Usuarios
    {
        return $this->usuarios;
    }

    public function setUsuarios(?Usuarios $usuarios): self
    {
        $this->usuarios = $usuarios;

        return $this;
    }
}
