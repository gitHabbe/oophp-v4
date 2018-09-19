<?php

class Dice
{
    private $roll;

    public function __construct(int $sides = 6)
    {
        $this->roll = rand(1, $sides);
    }

    public function roll()
    {
        $this->roll = rand(1, 6);
    }

    public function getRoll()
    {
        return $this->roll;
    }
}