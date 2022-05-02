<?php

namespace App\Model;

class WarriorAlliance extends BasicCharacter
{
    public function __construct()
    {
        $this->precision = 0.08;
        $this->damage = 30;
        $this->strikesInRound = 15;
        $this->fireBallCall = 0.05;
    }
}