<?php

namespace Hab\Dice;

/**
 * A interface for a classes supporting histogram reports.
 */
interface HistogramInterface
{
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogram();


    /**
     * Init the game.
     */
    public function init();


    /**
     * Check if round has ended.
     * Start new if necessary
     */
    public function checkForNewRound();
}