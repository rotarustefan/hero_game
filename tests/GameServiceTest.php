<?php

use PHPUnit\Framework\TestCase;
use \App\Entity\Stats;
use \App\Entity\Game;
use \App\Entity\Skill;
use \App\Entity\Hero;
use \App\Service\GameService;
use \App\Exception\InvalidRoundsInput;

final class GameServiceTest extends TestCase
{
    public function testInvalidRounds(): void
    {
        $stats1 = new Stats();
        $stats1
            ->setHealth(70, 100)
            ->setStrength(70, 80)
            ->setdeffence(45, 55)
            ->setSpeed(40, 50)
            ->setLuck(10, 30);

        $stats2 = new Stats();
        $stats2 = (new Stats)
            ->setHealth(60, 90)
            ->setStrength(60, 90)
            ->setdeffence(40, 60)
            ->setSpeed(40, 60)
            ->setLuck(25, 40);

        $skill1 = new Skill();
        $skill1
            ->setName('Rapid strike')
            ->setChance(10)
            ->setAttack(true)
            ->setPower(2);

        $skill2 = new Skill();
        $skill2
            ->setName('Magic shield')
            ->setChance(10)
            ->setAttack(false)
            ->setPower(0.5);


        $player1 = new Hero();
        $player1
            ->setName('Orderus')
            ->setStats($stats1)
            ->addSkill($skill1)
            ->addSkill($skill2);

        $player2 = new Hero();
        $player2
            ->setName('Computer')
            ->setStats($stats2);

        $game = new Game();
        $game->setPlayers($player1, $player2)->setRounds(5);

        $this->expectException(InvalidRoundsInput::class);

        $gameService = new GameService();
        $gameService->startGame($game);
    }

    public function testStartGame(): void
    {
        $stats1 = new Stats();
        $stats1
            ->setHealth(70, 100)
            ->setStrength(70, 80)
            ->setdeffence(45, 55)
            ->setSpeed(40, 50)
            ->setLuck(10, 30);

        $stats2 = new Stats();
        $stats2 = (new Stats)
            ->setHealth(60, 90)
            ->setStrength(60, 90)
            ->setdeffence(40, 60)
            ->setSpeed(40, 60)
            ->setLuck(25, 40);

        $skill1 = new Skill();
        $skill1
            ->setName('Rapid strike')
            ->setChance(10)
            ->setAttack(true)
            ->setPower(2);

        $skill2 = new Skill();
        $skill2
            ->setName('Magic shield')
            ->setChance(10)
            ->setAttack(false)
            ->setPower(0.5);


        $player1 = new Hero();
        $player1
            ->setName('Orderus')
            ->setStats($stats1)
            ->addSkill($skill1)
            ->addSkill($skill2);

        $player2 = new Hero();
        $player2
            ->setName('Computer')
            ->setStats($stats2);

        $game = new Game();
        $game->setPlayers($player1, $player2)->setRounds(20);

        $gameService = new GameService();
        $logs = $gameService->startGame($game);

        $this->assertNotEmpty($logs);
        $this->assertTrue(!$player1->getStats()->getHealth()['current'] or !$player2->getStats()->getHealth()['current'] or !$game->getRounds());
    }

    public function testInitializeGame(): void
    {
        $stats1 = new Stats();
        $stats1
            ->setHealth(70, 100)
            ->setStrength(70, 80)
            ->setdeffence(45, 55)
            ->setSpeed(40, 50)
            ->setLuck(10, 30);

        $stats2 = new Stats();
        $stats2 = (new Stats)
            ->setHealth(60, 90)
            ->setStrength(60, 90)
            ->setdeffence(40, 60)
            ->setSpeed(40, 60)
            ->setLuck(25, 40);

        $skill1 = new Skill();
        $skill1
            ->setName('Rapid strike')
            ->setChance(10)
            ->setAttack(true)
            ->setPower(2);

        $skill2 = new Skill();
        $skill2
            ->setName('Magic shield')
            ->setChance(10)
            ->setAttack(false)
            ->setPower(0.5);


        $player1 = new Hero();
        $player1
            ->setName('Orderus')
            ->setStats($stats1)
            ->addSkill($skill1)
            ->addSkill($skill2);

        $player2 = new Hero();
        $player2
            ->setName('Computer')
            ->setStats($stats2);

        $game = new Game();
        $game->setPlayers($player1, $player2)->setRounds(20);

        $gameService = new GameService();
        $gameService->initializeGame($game);

        $this->assertFalse(empty($game->getAttacker()));
        $this->assertFalse(empty($game->getDeffender()));
        $this->assertTrue(
            $game->getAttacker()->getStats()->getSpeed() > $game->getDeffender()->getStats()->getSpeed() || $game->getAttacker()->getStats()->getLuck() >= $game->getDeffender()->getStats()->getLuck()
        );
    }
}