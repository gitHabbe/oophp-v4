<?php

namespace Hab\Dice;

class DiceRound
{
    use DiceRoundTrait;

    private $turnOwner;
    private $completed;
    private $playerDone;
    private $computerDone;
    private $playerHand;
    private $computerHand;
    private $roundNr;

    public function __construct($num)
    {
        $this->roundNr = $num;
        $this->playerDone = false;
        $this->computerDone = false;
        $this->completed = false;
        $this->playerHand = new DiceHand();
        $this->computerHand = new DiceHand();
        $this->turnOwner = "";
    }
    
    public function whoGoesFirst()
    {
        $playerTotal = $this->playerHand->getTotal();
        $computerTotal = $this->computerHand->getTotal();
        if ($playerTotal === $computerTotal) {
            $this->whoGoesFirst();
        }
        $this->setPreTurnOwner($playerTotal, $computerTotal);
    }

    public function setPreTurnOwner($playerValue, $computerValue)
    {
        $this->turnOwner = ($playerValue > $computerValue ? "player" : "computer");
    }

    public function setTurnOwner($name)
    {
        $this->turnOwner = $name;
    }
    public function turnOwner()
    {
        return $this->turnOwner;
    }
    public function completeRound()
    {
        $this->completed = true;
    }
    public function isRoundComplete()
    {
        return $this->completed;
    }
    public function roundNr()
    {
        return $this->roundNr;
    }
    public function setPlayerDone()
    {
        $this->playerDone = true;
    }
    public function setComputerDone()
    {
        $this->computerDone = true;
    }
    public function playerDone()
    {
        return $this->playerDone;
    }
    public function computerDone()
    {
        return $this->computerDone;
    }
    public function playerHands()
    {
        return $this->playerHand;
    }
    public function computerHands()
    {
        return $this->computerHand;
    }
}
