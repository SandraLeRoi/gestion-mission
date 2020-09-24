<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nir;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="director")
     */
    private $director;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, inversedBy="employees")
     */
    private $compose;

    public function __construct()
    {
        $this->director = new ArrayCollection();
        $this->compose = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNir(): ?string
    {
        return $this->nir;
    }

    public function setNir(string $nir): self
    {
        $this->nir = $nir;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    public function addDirector(Team $director): self
    {
        if (!$this->director->contains($director)) {
            $this->director[] = $director;
            $director->setDirector($this);
        }

        return $this;
    }

    public function removeDirector(Team $director): self
    {
        if ($this->director->contains($director)) {
            $this->director->removeElement($director);
            // set the owning side to null (unless already changed)
            if ($director->getDirector() === $this) {
                $director->setDirector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getCompose(): Collection
    {
        return $this->compose;
    }

    public function addCompose(Team $compose): self
    {
        if (!$this->compose->contains($compose)) {
            $this->compose[] = $compose;
        }

        return $this;
    }

    public function removeCompose(Team $compose): self
    {
        if ($this->compose->contains($compose)) {
            $this->compose->removeElement($compose);
        }

        return $this;
    }

    public function __toString() {
        return $this->firstName.'-'.$this->lastName;
    }
}
