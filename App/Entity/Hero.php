<?php

namespace App\Entity;

class Hero {

    private $name;
    private $stats;
    private $skills = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStats(): Stats
    {
        return $this->stats;
    }

    public function setStats(Stats $stats): self
    {
        $this->stats = $stats;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function addSkill(Skill $skill): self
    {
        $this->skills[] = $skill;

        return $this;
    }

    public function setGameStats(): self
    {
        $this->stats->initializeGameStats();

        return $this;
    }
}