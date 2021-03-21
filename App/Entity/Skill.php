<?php
namespace App\Entity;

class Skill {

    private $name;
    private $chance;
    private $attack;
    private $power;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getChance(): int
    {
        return $this->chance;
    }

    public function setChance(int $chance): self
    {
        $this->chance = $chance;

        return $this;
    }

    public function isAttack(): bool
    {
        return $this->attack;
    }

    public function setAttack(bool $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getPower(): float
    {
        return $this->power;
    }

    public function setPower(float $power): self
    {
        $this->power = $power;

        return $this;
    }
}