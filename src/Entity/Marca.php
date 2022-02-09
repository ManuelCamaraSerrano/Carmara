<?php

namespace App\Entity;

use App\Repository\MarcaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarcaRepository::class)
 */
class Marca
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * 
     * @Assert\Length(
     *      min = 1,
     *      max = 20,
     *      minMessage = "El nombre debe tener mínimo {{ limit }} caracteres",
     *      maxMessage = "El nombre no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Coche::class, mappedBy="marca")
     */
    private $coches;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
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
     * @return Collection|Coche[]
     */
    public function getCoches(): Collection
    {
        return $this->coches;
    }

    public function addCoch(Coche $coch): self
    {
        if (!$this->coches->contains($coch)) {
            $this->coches[] = $coch;
            $coch->setMarca($this);
        }

        return $this;
    }

    public function removeCoch(Coche $coch): self
    {
        if ($this->coches->removeElement($coch)) {
            // set the owning side to null (unless already changed)
            if ($coch->getMarca() === $this) {
                $coch->setMarca(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
