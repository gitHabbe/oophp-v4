<?php

namespace Hab\Dice;

/**
 * I could refactor the setters and getters to not exist
 * but I think that looks worse.
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceGame implements DiceGameInterface
{

    use DiceGameTrait;
    
    private $rounds;
    private $computerTotal;
    private $computerCurrent;
    private $playerTotal;
    private $playerCurrent;
    private $gameInfo;
    // private $test;
    public function __construct()
    {
        $this->rounds = [];
        $this->computerTotal = 0;
        $this->computerCurrent = 0;
        $this->playerTotal = 0;
        $this->playerCurrent = 0;
        $this->gameInfo = "";
        // $this->test = [];
        $this->init();
    }

    public function init()
    {
        $round = new DiceRound(0);
        $round->whoGoesFirst();
        $winner = $round->turnOwner();
        $this->appendGameInfo("Game has started. <br>");
        $this->appendGameInfo($winner . " starts the game.<br>");
        $round->completeRound();
        $this->appendRounds($round);
        $currentRound = $this->checkForNewRound();
        $currentRound->setTurnOwner($winner);
        $this->appendRounds($currentRound);

        if ($currentRound->turnOwner() === "computer") {
            $this->playComputer();
        }
    }
    public function playComputer()
    {
        $currentRound = $this->checkForNewRound();
        $computerHand = $currentRound->computerHands();
        $playerHand = $currentRound->playerHands();
        $this->playerCurrent = 0;
        $this->computerCurrent = $computerHand->handValue();
        if ($computerHand->handValue() < 6 && $computerHand->handValue() != 0) {
            $computerHand->rollDices();
        }
        if ($computerHand->handValue() > 0) {
            $this->appendGameInfo("Computer scored " . $computerHand->handValue() . " points.<br>");
        } else {
            $this->appendGameInfo("Computer busted and got 0 points.<br>");
            $this->computerCurrent = "Busted!";
        }
        // $this->computerCurrent = $computerHand->handValue();
        $this->computerTotal += $computerHand->handValue();
        $currentRound->setComputerDone();
        $currentRound->setTurnOwner("player");
        $this->currentPlayer = $playerHand->handValue();
        if ($currentRound->playerDone()) {
            $currentRound->completeRound();
            $this->appendGameInfo("Round " . $currentRound->roundNr() . " complete.<br>");
            $this->appendRounds($currentRound);
        }
        if ($this->computerTotal >= 100) {
            $this->resetGameInfo();
            $this->appendGameInfo("Computer win!");
        }
    }
    
    public function playPlayer()
    {
        $currentRound = $this->checkForNewRound();
        $playerHand = $currentRound->playerHands();
        $this->playerCurrent = $playerHand->handValue();
        if ($this->playerCurrent === 0) {
            $currentRound->setPlayerDone();
            if ($currentRound->computerDone()) {
                $this->appendGameInfo("Player busted and got 0 points.<br>");
                $this->appendGameInfo("Round " . $currentRound->roundNr() . " complete.<br>");
                $currentRound->completeRound();
                $this->appendRounds($currentRound);
                $this->playComputer();
                $this->playerCurrent = "Busted!";
            } else {
                $this->playComputer();
            }
        }
        $playerHand->rollDices();
    }

    public function stay()
    {
        $currentRound = $this->checkForNewRound();
        // $playerHand = $currentRound->playerHands();
        $this->playerTotal += $this->playerCurrent;
        if ($currentRound->computerDone()) {
            $currentRound->completeRound();
            $this->appendGameInfo("Round complete.<br>");
            $this->appendRounds($currentRound);
        }
        $this->playComputer();
        if ($this->playerTotal >= 100) {
            $this->resetGameInfo();
            $this->appendGameInfo("Player win!");
        }
    }

    public function checkForNewRound()
    {
        $currentRound = $this->rounds[count($this->rounds) - 1];
        if ($currentRound->isRoundComplete()) {
            $currentRound->appendHands();
            $test = $currentRound->getSerie();
            $this->appendTest($test);
            // var_dump($this->test);

            $round = new DiceRound($currentRound->roundNr() + 1);
            $this->appendRounds($round);
            $this->resetGameInfo();
            $this->appendGameInfo("Round " . $currentRound->roundNr()
                . " has ended.<br>Round "
                . $round->roundNr() . " has started!<br>");
            return $round;
        }
        return $currentRound;
    }
    public function appendRounds($round)
    {
        array_push($this->rounds, $round);
    }
    public function resetGameInfo()
    {
        $this->gameInfo = "";
    }
    public function appendGameInfo($text)
    {
        $this->gameInfo .= $text;
    }
    public function gameInfo()
    {
        return $this->gameInfo;
    }
    public function rounds()
    {
        return $this->rounds;
    }
    public function computerTotal()
    {
        return $this->computerTotal;
    }
    public function computerCurrent()
    {
        return $this->computerCurrent;
    }
    public function playerTotal()
    {
        return $this->playerTotal;
    }
    public function playerCurrent()
    {
        return $this->playerCurrent;
    }
}
