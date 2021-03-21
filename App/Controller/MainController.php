<?php
namespace App\Controller;

use App\Entity\Game;
use App\Entity\Hero;
use App\Entity\Skill;
use App\Entity\Stats;
use App\Service\GameService;

class MainController
{
    public function index(): array
    {
        $stats1 = (new Stats())
            ->setHealth(70, 100)
            ->setStrength(70, 80)
            ->setdeffence(45, 55)
            ->setSpeed(40, 50)
            ->setLuck(10, 30);
        $stats2 = (new Stats)
            ->setHealth(60, 90)
            ->setStrength(60, 90)
            ->setdeffence(40, 60)
            ->setSpeed(40, 60)
            ->setLuck(25, 40);

        $skill1 = (new Skill())
            ->setName('Rapid strike')
            ->setChance(10)
            ->setAttack(true)
            ->setPower(2);
        $skill2 = (new Skill())
            ->setName('Magic shield')
            ->setChance(10)
            ->setAttack(false)
            ->setPower(0.5);


        $player1 = (new Hero())
            ->setName('Orderus')
            ->setStats($stats1)
            ->addSkill($skill1)
            ->addSkill($skill2);
        $player2 = (new Hero())
            ->setName('Computer')
            ->setStats($stats2);

        $game = (new Game())->setPlayers($player1, $player2)->setRounds(20);

        $gameService = new GameService();
        
        return $gameService->startGame($game);
    }
}