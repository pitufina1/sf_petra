<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoordinadorRepository")
 */
class Coordinador
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
     * @ORM\OneToMany(targetEntity="App\Entity\Alumno", mappedBy="coordinador")
     */
    private $alumnos;

    public function __construct()
    {
        $this->alumnos = new ArrayCollection();
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * @return Collection|Alumno[]
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Alumno $alumno): self
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos[] = $alumno;
            $alumno->setCoordinador($this);
        }

        return $this;
    }

    public function removeAlumno(Alumno $alumno): self
    {
        if ($this->alumnos->contains($alumno)) {
            $this->alumnos->removeElement($alumno);
            // set the owning side to null (unless already changed)
            if ($alumno->getCoordinador() === $this) {
                $alumno->setCoordinador(null);
            }
        }

        return $this;
    }
}
