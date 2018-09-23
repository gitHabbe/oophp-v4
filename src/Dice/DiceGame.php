<?php

namespace Hab\Dice;

class DiceGame
{
    private $playerCount;
    private $diceCount;
    private $players;

    public function __construct(int $playerCount = 3, int $diceCount = 3)
    {
        $this->playerCount = $playerCount;
        $this->diceCount = $diceCount;
        $this->players = [];
    }
    
    public function init()
    {
        echo '$this->diceCount' . ': ';
        var_dump($this->diceCount);
        for ($i=0; $i < $this->playerCount; $i++) {
            $this->players["player" . strval($i)] = new DiceHand($this->diceCount);
        }
    }

    public function players()
    {
        return $this->players;
    }
}
