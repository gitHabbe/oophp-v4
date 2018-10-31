<?php

namespace Hab\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait DiceHandTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];

    public function appendSerie($dice)
    {
        array_push($this->serie, $dice->value());
    }

    public function getSerie()
    {
        return $this->serie;
    }
}