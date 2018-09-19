<?php

class DiceHand
{
    private $dices;
    private $totalValue;

    public function __construct()
    {
        $this->dices = [];
        $this->totalValue = 0;
    }

    public function appendDice($dice)
    {
        array_push($this->dices, $dice);
        $this->totalValue += $dice->getRoll();
    }

    public function getDices()
    {
        return $this->dices;
    }

    public function handValue()
    {
        return $this->totalValue;
    }
}
