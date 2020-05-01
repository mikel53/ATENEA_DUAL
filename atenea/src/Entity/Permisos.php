<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PermisosRepository")
 */
class Permisos
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
    private $tipos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipos(): ?string
    {
        return $this->tipos;
    }

    public function setTipos(string $tipos): self
    {
        $this->tipos = $tipos;

        return $this;
    }
}
