<?php

namespace App\Entity;

use App\Repository\CocheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Oficina;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CocheRepository::class)
 */
class Coche 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotNull(
     *      message = "ERROR, Tiene que insertar una matricula"
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 12,
     *      minMessage = "La matricula debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "La matricula no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $matricula;

    /**
     * @ORM\ManyToOne(targetEntity=Marca::class, inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marca;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull(
     *      message = "ERROR, Tiene que insertar un Modelo"
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 60,
     *      minMessage = "El modelo debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El modelo no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $modelo;

    /**
     * @ORM\ManyToOne(targetEntity=oficina::class, inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $oficina;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(
     *      message = "ERROR, Tiene que insertar el número de puertas"
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 1,
     *      minMessage = "El número de puertas debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El número de puertas no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $npuertas;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $cambio;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 1,
     *      max = 3,
     *      minMessage = "Los cv debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "Los cv no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $cv;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 1,
     *      max = 4,
     *      minMessage = "El precio debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El precio no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 1,
     *      max = 40,
     *      minMessage = "El color debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El color no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Fotos::class, mappedBy="coche")
     */
    private $fotos;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="coche")
     */
    private $reservas;

    public function __construct()
    {
        $this->fotos = new ArrayCollection();
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getOficina(): ?oficina
    {
        return $this->oficina;
    }

    public function setOficina(?oficina $oficina): self
    {
        $this->oficina = $oficina;

        return $this;
    }

    public function getNpuertas(): ?int
    {
        return $this->npuertas;
    }

    public function setNpuertas(int $npuertas): self
    {
        $this->npuertas = $npuertas;

        return $this;
    }

    public function getCambio(): ?string
    {
        return $this->cambio;
    }

    public function setCambio(string $cambio): self
    {
        $this->cambio = $cambio;

        return $this;
    }

    public function getCv(): ?int
    {
        return $this->cv;
    }

    public function setCv(int $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Fotos[]
     */
    public function getFotos(): Collection
    {
        return $this->fotos;
    }

    public function addFoto(Fotos $foto): self
    {
        if (!$this->fotos->contains($foto)) {
            $this->fotos[] = $foto;
            $foto->setCoche($this);
        }

        return $this;
    }

    public function removeFoto(Fotos $foto): self
    {
        if ($this->fotos->removeElement($foto)) {
            // set the owning side to null (unless already changed)
            if ($foto->getCoche() === $this) {
                $foto->setCoche(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->matricula." ".$this->marca." ".$this->modelo;
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
            $reserva->setCoche($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getCoche() === $this) {
                $reserva->setCoche(null);
            }
        }

        return $this;
    }
}
