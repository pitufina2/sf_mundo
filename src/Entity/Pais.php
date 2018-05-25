<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaisRepository")
 */
class Pais
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
    private $continente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="provincias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Presidente", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $regiones;

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

    public function getContinente(): ?string
    {
        return $this->continente;
    }

    public function setContinente(string $continente): self
    {
        $this->continente = $continente;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getRegiones(): ?Presidente
    {
        return $this->regiones;
    }

    public function setRegiones(Presidente $regiones): self
    {
        $this->regiones = $regiones;

        return $this;
    }
}
