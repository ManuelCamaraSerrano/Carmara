<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProvinciaRepository::class)
 */
class Provincia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Oficina::class, mappedBy="provincia", orphanRemoval=true)
     */
    private $oficinas;

    public function __construct()
    {
        $this->oficinas = new ArrayCollection();
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
     * @return Collection|Oficina[]
     */
    public function getOficinas(): Collection
    {
        return $this->oficinas;
    }

    public function addOficina(Oficina $oficina): self
    {
        if (!$this->oficinas->contains($oficina)) {
            $this->oficinas[] = $oficina;
            $oficina->setProvincia($this);
        }

        return $this;
    }

    public function removeOficina(Oficina $oficina): self
    {
        if ($this->oficinas->removeElement($oficina)) {
            // set the owning side to null (unless already changed)
            if ($oficina->getProvincia() === $this) {
                $oficina->setProvincia(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nombre;
    }
}
