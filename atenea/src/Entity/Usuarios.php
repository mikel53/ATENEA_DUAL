<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuariosRepository")
 */
class Usuarios implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

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
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioRolGestion", mappedBy="usuarios",cascade={"persist", "remove"})
     */
    private $usuarioRolGestions;

    public function __construct()
    {
        $this->unidadGestions = new ArrayCollection();
        $this->usuarioRolGestions = new ArrayCollection();
    }

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->nombre;
    }

    public function setUsername(string $username): self
    {
        $this->nombre = $username;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        foreach ($roles as $rol) {

          if ($rol == "Admin") {
            $roles[] = 'ROLE_ADMIN';
          };

          if ($rol == "Super") {
            $roles[] = 'ROLE_SUPER';
          }
          if ($rol == "User"){
            $roles[] = 'ROLE_USER';

          }
        }

        return array_unique($roles);
    }
    public function getRole(): ?string
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        $text = "";
        for ($i=0; $i < $roles.length ; $i++) {
          $text =+ $this->$roles[$i];
        }
        return $text;
        //return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * @return Collection|UsuarioRolGestion[]
     */
    public function getUsuarioRolGestions(): Collection
    {
        return $this->usuarioRolGestions;
    }

    public function addUsuarioRolGestion(UsuarioRolGestion $usuarioRolGestion): self
    {
        if (!$this->usuarioRolGestions->contains($usuarioRolGestion)) {
            $this->usuarioRolGestions[] = $usuarioRolGestion;
            $usuarioRolGestion->setUsuarios($this);
        }

        return $this;
    }

    public function removeUsuarioRolGestion(UsuarioRolGestion $usuarioRolGestion): self
    {
        if ($this->usuarioRolGestions->contains($usuarioRolGestion)) {
            $this->usuarioRolGestions->removeElement($usuarioRolGestion);
            // set the owning side to null (unless already changed)
            if ($usuarioRolGestion->getUsuarios() === $this) {
                $usuarioRolGestion->setUsuarios(null);
            }
        }

        return $this;
    }



    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
