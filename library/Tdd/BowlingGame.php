<?php
/**
 * 12 TDDs of Christmas
 *
 * @link      http://github.com/jeremykendall/12-tdds-of-christmas for the canonical source repository
 * @copyright Copyright (c) 2012 Jeremy Kendall (http://about.me/jeremykendall)
 * @license   http://github.com/jeremykendall/12-tdds-of-christmas/blob/master/LICENSE MIT License
 * @see       http://www.wiredtothemoon.com/2012/12/12-tdds-of-christmas/ 12 TDDs of Chrismas blog post
 */

namespace Tdd;

/**
 * BowlingGame class
 *
 * Implementation of the bowling game kata
 *
 * @link    http://butunclebob.com/ArticleS.UncleBob.TheBowlingGameKata Uncle Bob's Bowling Game kata
 * @link    http://www.wiredtothemoon.com/2012/12/12-tdds-of-christmas/ 12 TDDs of Chrismas blog post
 * @package TwelveTddsOfChristmas\Day9
 */
class BowlingGame
{

    /**
     * @var \SplFixedArray Rolls
     */
    protected $rolls;

    /**
     * @var int Current roll
     */
    protected $currentRoll = 0;

    /**
     * Public constructor
     */
    public function __construct()
    {
        $this->rolls = new \SplFixedArray(21);
    }

    /**
     * Record a single roll
     *
     * @param int $pins How many pins were knocked down
     */
    public function roll($pins)
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    /**
     * Score bowling game
     *
     * @return int Game score
     */
    public function score()
    {
        $score = 0;
        $frameIndex = 0;

        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($frameIndex)) {
                $score += 10 + $this->strikeBonus($frameIndex);
                $frameIndex++;
            } elseif ($this->isSpare($frameIndex)) {
                $score += 10 + $this->spareBonus($frameIndex);
                $frameIndex += 2;
            } else {
                $score += $this->sumOfRollsInFrame($frameIndex);
                $frameIndex += 2;
            }
        }

        return $score;
    }

    /**
     * Calculates score for a single frame
     *
     * @param  int $frameIndex Index of frame to score
     * @return int Frame score
     */
    protected function sumOfRollsInFrame($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
    }

    /**
     * Calculates spare bonus
     *
     * @param  int $frameIndex Index of frame to score
     * @return int Spare bonus
     */
    protected function spareBonus($frameIndex)
    {
        return $this->rolls[$frameIndex + 2];
    }

    /**
     * Calculates strike bonus
     *
     * @param  int $frameIndex Index of frame to score
     * @return int Strike bonus
     */
    protected function strikeBonus($frameIndex)
    {
        return $this->rolls[$frameIndex + 1] + $this->rolls[$frameIndex + 2];
    }

    /**
     * Does this frame contain a spare?
     *
     * @param  int  $frameIndex Index of frame to test
     * @return bool True if frame is spare, false otherwise
     */
    public function isSpare($frameIndex)
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] == 10;
    }

    /**
     * Does this frame contain a strike?
     *
     * @param  int  $frameIndex Index of frame to test
     * @return bool True if frame is strike, false otherwise
     */
    public function isStrike($frameIndex)
    {
        return $this->rolls[$frameIndex] == 10;
    }
}
