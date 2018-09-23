<?php

namespace Hab\Dice;

class Dice
{
    private $sides;
    private $value;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
        $this->value = $this->roll();
        echo '$this->value' . ': ';
        var_dump($this->value);
    }

    public function reroll()
    {
        $this->value = $this->roll();
    }

    public function roll()
    {
        return rand(1, $this->sides);
    }

    public function value()
    {
        return $this->value;
    }
}
