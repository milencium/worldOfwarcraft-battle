<?php

namespace App\Model;

class WarriorHorde extends BasicCharacter
{
    public function __construct()
    {
        $this->precision = 0.25;
        $this->damage = 75;
        $this->strikesInRound = 15;
        $this->fireBallCall = 0.25;
    }
}