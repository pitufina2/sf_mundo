<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProvinciaRepository")
 */
class Provincia
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Localidad", inversedBy="provincia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localidad;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Region", mappedBy="provincia")
     */
    private $localidades;

    public function __construct()
    {
        $this->localidades = new ArrayCollection();
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

    public function getLocalidad(): ?Localidad
    {
        return $this->localidad;
    }

    public function setLocalidad(?Localidad $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getLocalidades(): Collection
    {
        return $this->localidades;
    }

    public function addLocalidade(Region $localidade): self
    {
        if (!$this->localidades->contains($localidade)) {
            $this->localidades[] = $localidade;
            $localidade->setProvincia($this);
        }

        return $this;
    }

    public function removeLocalidade(Region $localidade): self
    {
        if ($this->localidades->contains($localidade)) {
            $this->localidades->removeElement($localidade);
            // set the owning side to null (unless already changed)
            if ($localidade->getProvincia() === $this) {
                $localidade->setProvincia(null);
            }
        }

        return $this;
    }
}
