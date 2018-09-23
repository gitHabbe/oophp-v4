<?php

namespace Hab\Dice;

class DiceHand
{
    private $player;
    private $diceCount;
    private $dices;
    private $totalValue;

    public function __construct(int $diceCount = 3, string $player = "computer")
    {
        $this->player = $player;
        $this->diceCount = $diceCount;
        $this->dices = [];
        $this->totalValue = 0;

        // $this->rollDices();
    }

    public function rollDices()
    {
        $diceArray = [];
        $isAppendable = true;
        for ($i = 0; $i < $this->diceCount; $i++) {
            $dice = new Dice();
            if ($dice->value() === 1) {
                $isAppendable = false;
                $this->resetHand();
            }
            array_push($diceArray, $dice);
        }
        if ($isAppendable) {
            foreach ($diceArray as $diceObj) {
                array_push($this->dices, $diceObj);
                $this->totalValue += $diceObj->getRoll();
            }
        } else {
            throw Exception("One dice is 1");
        }
    }

    private function resetHand()
    {
        $this->dices = [];
        $this->totalValue = 0;
    }

    public function dices()
    {
        return $this->dices;
    }

    public function handValue()
    {
        return $this->totalValue;
    }

    public function player()
    {
        return $this->player;
    }
}
