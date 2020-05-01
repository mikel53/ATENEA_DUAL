<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuarios")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Permisos")
     */
    private $permiso;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnidadGestion")
     */
    private $unidadGestion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuarios
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuarios $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
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
}
