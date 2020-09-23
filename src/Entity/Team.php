<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="team")
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="director")
     */
    private $director;

    /**
     * @ORM\ManyToMany(targetEntity=Employee::class, mappedBy="compose")
     */
    private $employees;

    public function __construct()
    {
        $this->mission = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMission(): Collection
    {
        return $this->mission;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->mission->contains($mission)) {
            $this->mission[] = $mission;
            $mission->setTeam($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->mission->contains($mission)) {
            $this->mission->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getTeam() === $this) {
                $mission->setTeam(null);
            }
        }

        return $this;
    }

    public function getDirector(): ?Employee
    {
        return $this->director;
    }

    public function setDirector(?Employee $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->addCompose($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->contains($employee)) {
            $this->employees->removeElement($employee);
            $employee->removeCompose($this);
        }

        return $this;
    }
}
