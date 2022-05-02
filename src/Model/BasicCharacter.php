<?php


namespace App\Model;

use Exception;

abstract class BasicCharacter
{
    public $damage;
    public $precision;
    public $strikesInRound;
    public $fireBallCall;
    public $health = 75;

    /**
     * @param $opponentArmy 
     * @return string 
     * @throws Exception
     */
    public function attack(&$opponentArmy)
    {
        $outputResult = "";
        $shotsLeft = $this->strikesInRound;
        while ($shotsLeft > 0 && count($opponentArmy) > 0) {
            $targetIndex = $this->locate($opponentArmy);
            $outputResult .= $this->strike($opponentArmy[$targetIndex]);
            $outputResult .= $this->removeHero($targetIndex, $opponentArmy);
        }

        return $outputResult;
    }

    /**
     * @param $opponentArmy 
     * @return int 
     */
    private function locate(&$opponentArmy)
    {
        return mt_rand(0, count($opponentArmy) - 1);
    }

    /**
     * @param BasicCharacter $target 
     * @return string 
     */
    private function strike(BasicCharacter &$target)
    {
        $chance = mt_rand(0, 100) / 100;
        $hit = $chance <= $this->fireBallCall ? $this->damage * 2 : $this->damage;

        $outputResult = "";
        $target->health -= $hit;
        return $outputResult . sprintf(
            "Hero striked with damage %d and total health of hero is %d. ",
            $hit,
            $target->health < 0 ? 0 : $target->health
        );
    }

    /**
     * @param int 
     * @param $opponentArmy 
     * @return string 
     * @throws Exception
     */
    private function removeHero($targetIndex, &$opponentArmy)
    {
        if ($targetIndex >= count($opponentArmy)) {
            throw new Exception("Index out of range");
        }

        if ($opponentArmy[$targetIndex]->health <= 0) {
            unset($opponentArmy[$targetIndex]);
            $opponentArmy = array_values($opponentArmy);
            return "Hero eliminated. ";
        }
        return " ";
    }
}
