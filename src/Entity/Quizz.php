<?php

namespace App\Entity;

use App\Repository\QuizzRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzRepository::class)
 */
class Quizz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $n_species;

    /**
     * @ORM\Column(type="array")
     */
    private $species_list = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $n_turns;

    /**
     * @ORM\Column(type="integer")
     */
    private $current_turn;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNSpecies(): ?int
    {
        return $this->n_species;
    }

    public function setNSpecies(int $n_species): self
    {
        $this->n_species = $n_species;

        return $this;
    }

    public function getSpeciesList(): ?array
    {
        return $this->species_list;
    }

    public function setSpeciesList(array $species_list): self
    {
        $this->species_list = $species_list;

        return $this;
    }

    public function getNTurns(): ?int
    {
        return $this->n_turns;
    }

    public function setNTurns(int $n_turns): self
    {
        $this->n_turns = $n_turns;

        return $this;
    }

    public function getCurrentTurn(): ?int
    {
        return $this->current_turn;
    }

    public function setCurrentTurn(int $current_turn): self
    {
        $this->current_turn = $current_turn;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
