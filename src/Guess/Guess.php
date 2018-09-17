<?php

namespace Hab\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    private $number;
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;
        if ($this->number === -1) {
            $this->random();
        }
    }
    
    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
        // $this->unsetStart();
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }

     /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    
    public function makeGuess($number)
    {
        if (!is_int($number) || $number <= 0 || $number > 100) {
            throw new GuessException("Guess must be integer between 1 - 100");
        }
        // var_dump($number);
        if ($number == null) {
            return "Make a guess";
        }
        if ($this->tries() == 0) {
            return "Too many guesses used.";
        }
        
        $this->tries -= 1;
        if ($number === $this->number) {
            return "Correct! The secret number was <strong>" . $this->number . "</strong>";
        } elseif ($number > $this->number) {
            return "Too high! " . $this->tries . " remaining.";
        } elseif ($number < $this->number) {
            return "Too low! " . $this->tries . " remaining.";
        }
    }
}
