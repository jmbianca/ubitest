<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 */
class Grade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Student;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matter", inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Matter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->Student;
    }

    public function setStudent(?Student $Student): self
    {
        $this->Student = $Student;

        return $this;
    }

    public function getMatter(): ?Matter
    {
        return $this->Matter;
    }

    public function setMatter(?Matter $Matter): self
    {
        $this->Matter = $Matter;

        return $this;
    }
}
