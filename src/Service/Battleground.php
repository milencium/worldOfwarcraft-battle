<?php

namespace App\Service;

use App\Model\WarriorAlliance;
use App\Model\WarriorHorde;
use App\Model\DruidAlliance;
use App\Model\DruidHorde;
use App\Model\BasicCharacter;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Battleground
{

    private $battleArray;
    /**
     * @param $alliance 
     * @param $horde 
     * @return string 
     * @throws Exception
     */
    public function battleStart($alliance, $horde)
    {
        $outputResult = "";
        if (!is_int($alliance) || !is_int($horde) || $alliance <= 0 || $horde <= 0) {
            throw new BadRequestHttpException('Enter proper values for both alliance and horde');
        }
        $this->summonArmies($alliance, $horde);

        $outputResult .= sprintf(
            "Summoned battleArray!<br>Alliance:<br>WarriorAlliance: %d, DruidAlliance: %d<br>"
            . "Horde:<br>WarriorHorde: %d, DruidHorde: %d<br>",
            count(array_filter($this->battleArray[0], array($this, 'WarriorAlliance'))),
            count(array_filter($this->battleArray[0], array($this, 'DruidAlliance'))),
            count(array_filter($this->battleArray[1], array($this, 'WarriorHorde'))),
            count(array_filter($this->battleArray[1], array($this, 'DruidHorde')))
        );
        $outputResult .= $this->battle();

        return $outputResult;
    }

    /**
     * @param $alliance 
     * @param $horde 
     */
    private function summonArmies($alliance, $horde)
    {
        $this->battleArray = array();
        array_push($this->battleArray, $this->spawnAlliance($alliance));
        array_push($this->battleArray, $this->spawnHorde($horde));
    }

    /**
     * @param $army 
     * @return array 
     */
    private function spawnAlliance($army)
    {
        if (!is_int($army) || $army <= 0) {
            throw new BadRequestHttpException('Alliance does not exist');
        }
        $result = array();

        for ($i = 0; $i < $army; $i++) {
            $random = mt_rand(0, 125);
            switch (true) {
                case $random <= 50:
                    array_push($result, new DruidAlliance());
                    break;
                case $random <= 80:
                    array_push($result, new WarriorAlliance());
                    break;
            }
        }

        return $result;
    }
    private function spawnHorde($army)
    {
        if (!is_int($army) || $army <= 0) {
            throw new BadRequestHttpException('Horde does not exist');
        }
        $result = array();

        for ($i = 0; $i < $army; $i++) {
            $random = mt_rand(0, 125);
            switch (true) {
                case $random <= 50:
                    array_push($result, new DruidHorde());
                    break;
                case $random <= 80:
                    array_push($result, new WarriorHorde());
                    break;
            }
        }

        return $result;
    }


    /**
     * @return string 
     * @throws Exception
     */
    private function battle()
    {
        $outputResult = "";
        $turn = mt_rand(0, 1);

        while (count($this->battleArray[0]) > 0 && count($this->battleArray[1]) > 0) {
            $outputResult .= $turn == 0 ? "Alliance strikes<br>" : "Horde strikes<br>";
            $donthaveAggroIndex = ($turn + 1) % 2;

            $haveAggro = &$this->battleArray[$turn];
            $donthaveAggro = &$this->battleArray[$donthaveAggroIndex];

            for ($i = 0; $i < count($haveAggro) && count($donthaveAggro) > 0; $i++) {
                $outputResult .= sprintf("Hero %d attacks.<br>", $i);
                /** @var BasicCharacter[] $haveAggro */
                $outputResult .= $haveAggro[$i]->attack($donthaveAggro);
            }
            $outputResult .= sprintf(
                "Strike finished! Alliance: %d  Horde: %d <br><br>",
                count($this->battleArray[0]),
                count($this->battleArray[1])
            );
            $turn = $donthaveAggroIndex;
        }

        $outputResult .= count($this->battleArray[0]) > 0 ? "Alliance wins the battle" : "Horde wins the battle";

        return $outputResult;
    }

    /**
     * @param $elementCheck 
     * @return bool 
     */
    private function WarriorAlliance($elementCheck)
    {
        return $elementCheck instanceof WarriorAlliance;
    }
    /**
     * @param $elementCheck 
     * @return bool 
     */
    private function WarriorHorde($elementCheck)
    {
        return $elementCheck instanceof WarriorHorde;
    }

    /**
     * @param $elementCheck 
     * @return bool 
     */
    private function DruidAlliance($elementCheck)
    {
        return $elementCheck instanceof DruidAlliance;
    }
    /**
     * @param $elementCheck 
     * @return bool 
     */
    private function DruidHorde($elementCheck)
    {
        return $elementCheck instanceof DruidHorde;
    }
}
