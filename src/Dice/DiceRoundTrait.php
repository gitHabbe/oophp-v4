<?php

namespace Hab\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait DiceRoundTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];

    public function appendHands()
    {
        foreach ($this->playerHands()->getSerie() as $value) {
            array_push($this->serie, $value);
        }
        foreach ($this->computerHands()->getSerie() as $value) {
            array_push($this->serie, $value);
        }
    }

    public function getSerie()
    {
        return $this->serie;
    }
}
