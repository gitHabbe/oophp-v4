<?php

namespace Hab\Dice;

class Dice
{
    private $sides;
    private $value;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
        $this->value = rand(1, $this->sides);
    }

    public function value()
    {
        return $this->value;
    }
    public function sides()
    {
        return $this->sides;
    }
}
