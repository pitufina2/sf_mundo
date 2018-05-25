<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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
     * @ORM\Column(type="string", length=100)
     */
    private $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provincia", inversedBy="localidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pais", mappedBy="region")
     */
    private $provincias;

    public function __construct()
    {
        $this->provincias = new ArrayCollection();
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

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): self
    {
        $this->idioma = $idioma;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * @return Collection|Pais[]
     */
    public function getProvincias(): Collection
    {
        return $this->provincias;
    }

    public function addProvincia(Pais $provincia): self
    {
        if (!$this->provincias->contains($provincia)) {
            $this->provincias[] = $provincia;
            $provincia->setRegion($this);
        }

        return $this;
    }

    public function removeProvincia(Pais $provincia): self
    {
        if ($this->provincias->contains($provincia)) {
            $this->provincias->removeElement($provincia);
            // set the owning side to null (unless already changed)
            if ($provincia->getRegion() === $this) {
                $provincia->setRegion(null);
            }
        }

        return $this;
    }
}
