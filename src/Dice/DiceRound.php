<?php

class DiceRound
{
    private $diceHands;

    public function __construct()
    {
        $this->diceHands = [];
    }

    public function appendRound($diceHand)
    {
        array_push($this->diceHands, $diceHand);
    }

    public function getHands()
    {
        return $this->diceHands;
    }
}
