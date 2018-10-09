<?php

namespace Hab\Dice;

class DiceHand
{
    private $diceCount;
    private $dices;
    private $totalValue;

    public function __construct(int $diceCount = 3)
    {
        $this->diceCount = $diceCount;
        $this->dices = [];
        $this->totalValue = 0;
        $this->rollDices();
    }

    public function rollDices()
    {
        $playable = true;
        $diceArray = [];
        for ($i = 0; $i < $this->diceCount; $i++) {
            $dice = new Dice();
            if ($dice->value() === 1) {
                $playable = false;
                $this->resetHand();
            }
            // var_dump($diceArray);
            array_push($diceArray, $dice);
        }
        if ($playable) {
            foreach ($diceArray as $dice) {
                array_push($this->dices, $dice);
                $this->totalValue += $dice->value();
            }
        }
    }
    public function getTotal()
    {
        $total = 0;
        for ($i=0; $i < 3; $i++) {
            $dice = new Dice();
            $total += $dice->value();
        }
        return $total;
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
}
