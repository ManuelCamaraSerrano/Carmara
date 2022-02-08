<?php

namespace App\Entity;

use App\Repository\CocheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Oficina;

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
     */
    private $matricula;

    /**
     * @ORM\ManyToOne(targetEntity=Marca::class, inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marca;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $modelo;

    /**
     * @ORM\ManyToOne(targetEntity=oficina::class, inversedBy="coches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $oficina;

    /**
     * @ORM\Column(type="integer")
     */
    private $npuertas;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $cambio;

    /**
     * @ORM\Column(type="integer")
     */
    private $cv;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Fotos::class, mappedBy="coche")
     */
    private $fotos;

    public function __construct()
    {
        $this->fotos = new ArrayCollection();
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
}
