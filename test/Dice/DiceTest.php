<?php

namespace Hab\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceTest extends TestCase
{
    public function testDiceSides()
    {
        $dice = new Dice();
        $res = $dice->sides();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }
    public function testDiceInstance()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Hab\Dice\Dice", $dice);
    }
    public function testDiceHandValue()
    {
        $diceHand = new DiceHand();
        if (count($diceHand->dices()) === 0) {
            $exp = 0;
            $res = $diceHand->handValue();
            $this->assertEquals($exp, $res);
        } else {
            $exp = 5;
            $res = $diceHand->handValue();
            $this->assertGreaterThan($exp, $res);
        }
    }
    public function testDiceRoundNr()
    {
        $round = new DiceRound(1);
        $exp = 0;
        $res = $round->roundNr();
        $this->assertNotEquals($exp, $res);
    }
    public function testDiceGameComputerPreGameRoll()
    {
        $game = new DiceGame();
        $res = $game->rounds()[0]->computerHands()->getTotal();
        $exp = 0;
        $this->assertNotEquals($exp, $res);
    }
    public function testDiceGameInfo()
    {
        $game = new DiceGame();
        $game->resetGameInfo();
        $game->appendGameInfo("Testing");
        $exp = "Testing";
        $res = $game->gameInfo();
        $this->assertEquals($exp, $res);
    }
    public function testDiceGameRounds()
    {
        $game = new DiceGame();
        $round = new DiceRound(4);
        $game->appendRounds($round);
        $exp = "\Hab\Dice\DiceRound";
        $res = $game->rounds();
        $res = $res[0];
        $this->assertInstanceOf($exp, $res);
    }
    public function testDiceRoundDones()
    {
        $round = new DiceRound(2);
        $round->setPlayerDone();
        $round->setComputerDone();
        $exp = true;
        $res = $round->playerDone();
        $this->assertEquals($exp, $res);
        $res = $round->computerDone();
        $this->assertEquals($exp, $res);
        if ($round->computerDone() && $round->playerDone()) {
            $round->completeRound();
        }
        $exp = false;
        $res = $round->isRoundComplete();
        $this->assertNotEquals($exp, $res);
    }
    public function testDiceRoundTurnOwner()
    {
        $round = new DiceRound(4);
        $round->whoGoesFirst();
        $exp = ["computer", "player"];
        $res = $round->turnOwner();
        $this->assertContains($res, $exp);
    }
    public function testDiceGameValues()
    {
        $game = new DiceGame();
        $exp = 1;
        $res = $game->computerTotal();
        $this->assertLessThan($exp, $res);
        $res = $game->computerCurrent();
        $this->assertLessThan($exp, $res);
        $res = $game->playerTotal();
        $this->assertLessThan($exp, $res);
        $res = $game->playerCurrent();
        $this->assertLessThan($exp, $res);
    }
}
