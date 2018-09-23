<?php

namespace Hab\Dice;

class DiceRound
{
    private $players;
    // private $playerCount;
    private $currentPlayer;

    public function __construct()
    {
        // for ($i=0; $i < $playerCount; $i++) {
        //     $this->players[$i] = new DiceHand(strval($i));
        //     array_push($this->hands, $this->players[$i]);
        // }
    }

    public function appendRound($diceHand)
    {
        array_push($this->hands, $diceHand);
    }

    public function currentPlayer()
    {
        return $this->hands;
    }
}
