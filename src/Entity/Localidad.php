<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalidadRepository")
 */
class Localidad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="float")
     */
    private $area;

    /**
     * @ORM\Column(type="integer")
     */
    private $habitantes;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Provincia", mappedBy="localidad")
     */
    private $provincia;

    public function __construct()
    {
        $this->provincia = new ArrayCollection();
    }

    public function getId()
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

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(float $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getHabitantes(): ?int
    {
        return $this->habitantes;
    }

    public function setHabitantes(int $habitantes): self
    {
        $this->habitantes = $habitantes;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection|Provincia[]
     */
    public function getProvincia(): Collection
    {
        return $this->provincia;
    }

    public function addProvincium(Provincia $provincium): self
    {
        if (!$this->provincia->contains($provincium)) {
            $this->provincia[] = $provincium;
            $provincium->setLocalidad($this);
        }

        return $this;
    }

    public function removeProvincium(Provincia $provincium): self
    {
        if ($this->provincia->contains($provincium)) {
            $this->provincia->removeElement($provincium);
            // set the owning side to null (unless already changed)
            if ($provincium->getLocalidad() === $this) {
                $provincium->setLocalidad(null);
            }
        }

        return $this;
    }
}
