<?php

class DiceHand
{
    private $player;
    private $dices;
    private $totalValue;

    public function __construct($name)
    {
        $this->player = $name;
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

    public function getPlayer()
    {
        return $this->player;
    }
}
