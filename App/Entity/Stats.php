<?php
namespace App\Entity;

class Stats
{
    private $health =
        [
            'min' => null,
            'max' => null,
            'current' => 0
        ];
    private $strength =
        [
            'min' => null,
            'max' => null,
            'current' => 0
        ];
    private $deffence =
        [
            'min' => null,
            'max' => null,
            'current' => 0
        ];
    private $speed =
        [
            'min' => null,
            'max' => null,
            'current' => 0
        ];
    private $luck =
        [
            'min' => null,
            'max' => null,
            'current' => 0
        ];

    public function getHealth(): array
    {
        return $this->health;
    }

    public function setHealth(int $min, int $max): self
    {
        $this->health['min'] = $min;
        $this->health['max'] = $max;

        return $this;
    }

    public function updateCurrentHealth(float $current): self
    {   
        $this->health['current'] = $current;
        return $this;
    }

    public function getStrength(): array
    {
        return $this->strength;
    }

    public function setStrength(int $min, int $max): self
    {
        $this->strength['min'] = $min;
        $this->strength['max'] = $max;

        return $this;
    }

    public function getdeffence(): array
    {
        return $this->deffence;
    }

    public function setdeffence(int $min, int $max): self
    {
        $this->deffence['min'] = $min;
        $this->deffence['max'] = $max;

        return $this;
    }

    public function getSpeed(): array
    {
        return $this->speed;
    }

    public function setSpeed(int $min, int $max): self
    {
        $this->speed['min'] = $min;
        $this->speed['max'] = $max;

        return $this;
    }

    public function getLuck(): array
    {
        return $this->luck;
    }

    public function setLuck(int $min, int $max): self
    {
        $this->luck['min'] = $min;
        $this->luck['max'] = $max;

        return $this;
    }

    public function initializeGameStats()
    {
        $this->health['current'] = rand($this->health['min'], $this->health['max']);
        $this->strength['current'] = rand($this->strength['min'], $this->strength['max']);
        $this->deffence['current'] = rand($this->deffence['min'], $this->deffence['max']);
        $this->speed['current'] = rand($this->speed['min'], $this->speed['max']);
        $this->luck['current'] = rand($this->luck['min'], $this->luck['max']);
    }

}

?>