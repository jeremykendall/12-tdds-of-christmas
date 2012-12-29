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
 * CalcStats provides data about a sequence of numbers
 *
 * @package TwelveTddsOfChristmas\Day1
 */
class CalcStats
{
    /**
     * @var array Array of integers
     */
    protected $sequence;

    /**
     * Public constructor
     *
     * @param array $sequence Array of integers
     */
    public function __construct(array $sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Gets minimum sequence value
     *
     * @return int Minimum value
     */
    public function getMinimumValue()
    {
        return min($this->sequence);
    }

    /**
     * Gets maximum sequence value
     *
     * @return int Maximum value
     */
    public function getMaximumValue()
    {
        return max($this->sequence);
    }

    /**
     * Gets count of numbers in sequence
     *
     * @return int Count of numbers in sequence
     */
    public function countElements()
    {
        return count($this->sequence);
    }

    /**
     * Gets average of numbers in sequence
     *
     * @return float Average of numbers in sequence
     */
    public function getAverageValue()
    {
        $total = $this->countElements();

        return number_format(array_sum($this->sequence) / $this->countElements(), 6);
    }

}
