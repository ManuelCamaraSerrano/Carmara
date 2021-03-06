<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es un email valido."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 70,
     *      minMessage = "El gmail debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El gmail no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string",length=600, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=9, unique=true, nullable=true)
     * @Assert\Length(
     *      min = 9,
     *      max = 9,
     *      minMessage = "El dni debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El dni no puede tener más de {{ limit }} caracteres"
     * )
     * @Assert\NotNull(
     *      message = "ERROR, El dni no puede dejarlo vacio"
     * )
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "El nombre debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El nombre no puede tener más de {{ limit }} caracteres"
     * )
     * @Assert\NotNull(
     *      message = "ERROR, El nombre no puede dejarlo vacio."
     * )
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(
     *      min = 1,
     *      max = 40,
     *      minMessage = "El apellido debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El apellido no puede tener más de {{ limit }} caracteres"
     * )
     * @Assert\NotNull(
     *      message = "ERROR, No puede dejar los apellidos vacio."
     * )
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull(
     *      message = "ERROR, El telefono no puede dejarlo vacio."
     * )
     */
    private $telefono;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="Usuario")
     */
    private $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @return Collection|Reserva[]
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setUsuario($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getUsuario() === $this) {
                $reserva->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->dni." ".$this->nombre;
    }
}
