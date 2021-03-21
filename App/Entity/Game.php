<?php
namespace App\Entity;

class Game {

    private $rounds;
    private $player1;
    private $player2;
    private $attacker;
    private $deffender;
    private $gameLog = [];
    private float $damage;

    public function getRounds(): int
    {
        return $this->rounds;
    }

    public function setRounds(int $rounds): self
    {
        $this->rounds = $rounds;

        return $this;
    }

    public function getPlayer1(): Hero
    {
        return $this->player1;
    }

    public function setPlayer1(Hero $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): Hero
    {
        return $this->player2;
    }

    public function setPlayer2(Hero $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function setPlayers(Hero $player1, Hero $player2): self
    {
        $this->player1 = $player1;
        $this->player2 = $player2;

        return $this;
    }

    public function getAttacker(): Hero
    {
        return $this->attacker;
    }

    public function setAttacker(Hero $attacker): self
    {
        $this->attacker = $attacker;

        return $this;
    }

    public function getDeffender(): Hero
    {
        return $this->deffender;
    }

    public function setDeffender(Hero $deffender): self
    {
        $this->deffender = $deffender;

        return $this;
    }

    public function getGameLog(): array
    {
        return $this->gameLog;
    }

    public function setGameLog(array $gameLog): self
    {
        $this->gameLog = $gameLog;

        return $this;
    }

    public function addLog(string $log): self
    {
        $this->gameLog[] = $log;

        return $this;
    }

    public function getDamage(): float
    {
        return $this->damage;
    }

    public function setDamage(float $damage): self
    {
        $this->damage = $damage;

        return $this;
    }
}