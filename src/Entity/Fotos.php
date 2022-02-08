<?php

namespace App\Entity;

use App\Repository\FotosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FotosRepository::class)
 */
class Fotos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $foto;

    /**
     * @ORM\ManyToOne(targetEntity=Coche::class, inversedBy="fotos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coche;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCoche(): ?Coche
    {
        return $this->coche;
    }

    public function setCoche(?Coche $coche): self
    {
        $this->coche = $coche;

        return $this;
    }
}
