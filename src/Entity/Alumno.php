<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlumnoRepository")
 */
class Alumno
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $apellidos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coordinador", inversedBy="alumnos")
     */
    private $coordinador;

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCoordinador(): ?Coordinador
    {
        return $this->coordinador;
    }

    public function setCoordinador(?Coordinador $coordinador): self
    {
        $this->coordinador = $coordinador;

        return $this;
    }
}
