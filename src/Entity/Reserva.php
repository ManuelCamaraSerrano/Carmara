<?php

namespace App\Entity;
use App\Entity\Oficina;
use App\Entity\Coche;
use App\Entity\Usuario;
use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Usuario;

    /**
     * @ORM\ManyToOne(targetEntity=coche::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coche;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fechaini;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fechafin;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrecioTotal;

    /**
     * @ORM\ManyToOne(targetEntity=oficina::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $oficinadevolucion;

    /**
     * @ORM\ManyToOne(targetEntity=oficina::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $OficinaRecogida;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->Usuario;
    }

    public function setUsuario(?Usuario $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getCoche(): ?coche
    {
        return $this->coche;
    }

    public function setCoche(?coche $coche): self
    {
        $this->coche = $coche;

        return $this;
    }

    public function getFechaini(): ?\DateTimeInterface
    {
        return $this->Fechaini;
    }

    public function setFechaini(\DateTimeInterface $Fechaini): self
    {
        $this->Fechaini = $Fechaini;

        return $this;
    }

    public function getFechafin(): ?\DateTimeInterface
    {
        return $this->Fechafin;
    }

    public function setFechafin(\DateTimeInterface $Fechafin): self
    {
        $this->Fechafin = $Fechafin;

        return $this;
    }

    public function getPrecioTotal(): ?int
    {
        return $this->PrecioTotal;
    }

    public function setPrecioTotal(int $PrecioTotal): self
    {
        $this->PrecioTotal = $PrecioTotal;

        return $this;
    }

    public function getOficinadevolucion(): ?oficina
    {
        return $this->oficinadevolucion;
    }

    public function setOficinadevolucion(?oficina $oficinadevolucion): self
    {
        $this->oficinadevolucion = $oficinadevolucion;

        return $this;
    }

    public function getOficinaRecogida(): ?oficina
    {
        return $this->OficinaRecogida;
    }

    public function setOficinaRecogida(?oficina $OficinaRecogida): self
    {
        $this->OficinaRecogida = $OficinaRecogida;

        return $this;
    }
}
