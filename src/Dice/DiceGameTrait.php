<?php

namespace Hab\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait DiceGameTrait
{
    
    private $test = [];

    public function appendTest($para)
    {
        foreach ($para as $value) {
            array_push($this->test, $value);
        }
    }
    
    public function showTest()
    {
        return $this->test;
    }

    public function getHistoGram()
    {
        $highest = max($this->test);
        $histoString = "<br>";
        $histoArray = array_fill(1, $highest, '');
        foreach ($this->test as $key => $value) {
            $histoArray[$value] .= "*";
        }
        foreach ($histoArray as $key => $value) {
            $histoString .= $key . ": " . $value . "<br>";
        }
        return $histoString;
    }
}