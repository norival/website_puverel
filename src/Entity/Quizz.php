<?php

namespace App\Entity;

use App\Repository\QuizzRepository;
use App\Repository\SpeciesRepository;
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

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $choices = [];

    public function __construct(private SpeciesRepository $speciesRepository)
    {
        /* dump($this->speciesRepository->findBy([ 'quizz' => $this->n_species ])); */
        /* dump($this->speciesRepository->findAll()); */
    }

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

    public function getCurrentSpecies(): Species
    {
        return $this->getSpeciesList()[$this->getCurrentTurn() - 1 ];
    }

    public function init($nSpecies)
    {
        $this->setNSpecies($nSpecies);

        // TODO generate species list based on number of species
        $speciesListUnique = $this->speciesRepository->findBy([ 'quizz' => $this->getNSpecies() ]);

        $this->species_list =
            $this->n_species === 5
            ? array_merge($speciesListUnique, $speciesListUnique, $speciesListUnique)
            : array_merge($speciesListUnique, $speciesListUnique);
        shuffle($this->species_list);

        // TODO set the current turn to 1
        $this->setCurrentTurn(1);

        // TODO set the number of turns depending on the number of species
        $this->setNTurns(
            $this->getNSpecies() === 5
            ? 3 * $nSpecies
            : 2 * $nSpecies
        );

        $this->setScore(0);
        $this->setChoices();
    }

    public function getChoices(): Array
    {
        return $this->choices;
    }

    public function setChoices(): self
    {
        $speciesListUnique = array_unique($this->species_list, SORT_REGULAR);
        $choices = array_filter($speciesListUnique, fn($species) => $species !== $this->getCurrentSpecies());
        $choices = array_rand($choices, 3);
        $choices = array_flip($choices);
        $choices = [
            $this->getCurrentSpecies(),
            ...array_intersect_key($speciesListUnique, $choices)
        ];
        shuffle($choices);

        $this->choices = $choices;

        return $this;
    }
}
