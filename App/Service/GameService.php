<?php
namespace App\Service;

use App\Entity\Game;
use App\Entity\Skill;
use App\Exception\InvalidPlayerInput;
use App\Exception\InvalidRoundsInput;
use function PHPUnit\Framework\throwException;

class GameService
{
    private const CURRENT_KEY = 'current';
    
    public function startGame(Game $game)
    {
        try {
            $this->checkGameInput($game);
            $this->initializeGame($game);
            while($game->getRounds() && $game->getAttacker()->getStats()->getHealth()[self::CURRENT_KEY] && $game->getDeffender()->getStats()->getHealth()[self::CURRENT_KEY]) {
                $this->round($game);
            }

            $this->getResults($game);

            return $game->getGameLog();

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function initializeGame(Game $game): void
    {
        $game->getPlayer1()->setGameStats();
        $game->getPlayer2()->setGameStats();

        $game->setAttacker($game->getPlayer1());
        $game->setDeffender($game->getPlayer2());

        $player1Stats = $game->getPlayer1()->getStats();
        $player2Stats = $game->getPlayer2()->getStats();

        if ($player1Stats->getSpeed()[self::CURRENT_KEY] !== $player2Stats->getSpeed()[self::CURRENT_KEY]) {
            if($player2Stats->getSpeed()[self::CURRENT_KEY] > $player1Stats->getSpeed()[self::CURRENT_KEY]){
                $game->setAttacker($game->getPlayer2());
                $game->setDeffender($game->getPlayer1());
            }
        } else if ($player2Stats->getLuck()[self::CURRENT_KEY] > $player1Stats->getLuck()[self::CURRENT_KEY]){
            $game->setAttacker($game->getPlayer2());
            $game->setDeffender($game->getPlayer1());
        }

        $game->addLog('Initial stats are: '.$game->getAttacker()->getName().'(Health:'.$game->getAttacker()->getStats()->getHealth()[self::CURRENT_KEY].') '.$game->getDeffender()->getName().'(Health:'.$game->getDeffender()->getStats()->getHealth()[self::CURRENT_KEY].')');
    }

    private function strike(Game $game): void
    {
        $deffenderGameStats = $game->getDeffender()->getStats();
        $attackerGameStats = $game->getAttacker()->getStats();

        $message = $game->getDeffender()->getName().' was lucky and did not take any damage';

        if(rand(0, 100) > $deffenderGameStats->getLuck()[self::CURRENT_KEY]){

            $game->setDamage($attackerGameStats->getStrength()[self::CURRENT_KEY] - $deffenderGameStats->getdeffence()[self::CURRENT_KEY]);

            foreach($game->getAttacker()->getSkills() as $skill) {
                if($skill->isAttack()){
                    $this->getEmpoweredDamage($game, $skill);
                }
            }

            foreach($game->getDeffender()->getSkills() as $skill) {
                if(!$skill->isAttack()){
                    $this->getEmpoweredDamage($game, $skill);
                }
            }

            $message = $game->getAttacker()->getName().' tried to damage '.$game->getDeffender()->getName().' but he is to weak';

            if($game->getDamage() > 0) {

                $deffenderGameStats->updateCurrentHealth($deffenderGameStats->getHealth()[self::CURRENT_KEY] - $game->getDamage());

                if($deffenderGameStats->getHealth()[self::CURRENT_KEY] < 0) {
                    $deffenderGameStats->updateCurrentHealth(0);
                }

                $message = $game->getAttacker()->getName().' damaged '.$game->getDeffender()->getName().' with '.$game->getDamage().'. Now their stats are: '.$game->getAttacker()->getName().'(Health:'.$attackerGameStats->getHealth()[self::CURRENT_KEY].') '.$game->getDeffender()->getName().'(Health:'.$deffenderGameStats->getHealth()[self::CURRENT_KEY].')';
            }
        }

        $game->addLog($message);
    }

    private function round(Game $game): void
    {
        $this->strike($game);
        $game->setRounds($game->getRounds() - 1) ;
        $pivote = $game->getAttacker();
        $game->setAttacker($game->getDeffender());
        $game->setDeffender($pivote);
    }

    private function getEmpoweredDamage(Game $game, Skill $skill)
    {
        $luck = random_int(0, 100);

        if ($luck <= $skill->getChance()) {
            $game->setDamage($game->getDamage() * $skill->getPower());
            $message = $game->getDeffender()->getName().' was lucky and had '.$skill->getName();
            if($skill->isAttack()) {
                $message = $game->getAttacker()->getName().' was lucky and had '.$skill->getName();
            }

            $game->addLog($message);
        }
    }

    private function getResults(Game $game) {
        $message = 'The maximum rounds has been reached and nobody won';

        if($game->getPlayer1()->getStats()->getHealth()[self::CURRENT_KEY] == 0) {
            $message = $game->getPlayer2()->getName().' won this game';
        }

        if($game->getPlayer2()->getStats()->getHealth()[self::CURRENT_KEY] == 0) {
            $message = $game->getPlayer1()->getName().' won this game';
        }

        $game->addLog($message);
    }

    private function checkGameInput(Game $game)
    {
        if($game->getRounds() !== 20){
            throw new InvalidRoundsInput();
        }
    }
}