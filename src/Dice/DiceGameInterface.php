<?php

namespace Hab\Dice;

interface DiceGameInterface
{
    /**
     * Init game and start first round.
     */
    public function init();


    /**
     * Append rolls into total array.
     */
    public function appendTest($para);


    /**
     * @return String with histogram data.
     */
    public function getHistoGram();
}
