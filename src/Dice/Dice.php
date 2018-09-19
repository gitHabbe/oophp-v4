<?php

namespace Hab\Dice;

class Dice
{
    private $roll;

    public function __construct(int $sides = 6)
    {
        $this->roll = rand(1, $sides);
    }

    public function roll()
    {
        $this->roll = rand(1, $this->sides);
    }

    public function getRoll()
    {
        return $this->roll;
    }
}