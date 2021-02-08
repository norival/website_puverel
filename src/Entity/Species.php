<?php

namespace App\Entity;

use App\Repository\SpeciesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SpeciesRepository::class)
 */
class Species
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"quizz"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"quizz"})
     */
    private $genus;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"quizz"})
     */
    private $species;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"quizz"})
     */
    private $common_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"quizz"})
     */
    private $file_path;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quizz;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"quizz"})
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(string $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getCommonName(): ?string
    {
        return $this->common_name;
    }

    public function setCommonName(string $common_name): self
    {
        $this->common_name = $common_name;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return "build/images/species/{$this->file_path}";
    }

    public function setFilePath(string $file_path): self
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function getQuizz(): ?int
    {
        return $this->quizz;
    }

    public function setQuizz(?int $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
