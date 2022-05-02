<?php

namespace App\Model;

class DruidHorde extends BasicCharacter
{
    public function __construct()
    {
        $this->precision = 0.4;
        $this->damage = 50;
        $this->strikesInRound = 1;
        $this->fireBallCall = 0.2;
    }
}