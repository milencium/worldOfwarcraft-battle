<?php

namespace App\Model;

class DruidAlliance extends BasicCharacter
{
    public function __construct()
    {
        $this->precision = 0.8;
        $this->damage = 70;
        $this->strikesInRound = 1;
        $this->fireBallCall = 0.5;
    }
}