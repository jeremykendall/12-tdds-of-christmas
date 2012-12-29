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
 * CalcStats provides data about a sequence of numbers: #12TDDs Day One
 *
 * @package TwelveTddsOfChristmas\Day1
 */
class CalcStats
{
    protected $sequence;

    public function __construct(array $sequence)
    {
        $this->sequence = $sequence;
    }

    public function getMinimumValue()
    {
        return min($this->sequence);
    }

    public function getMaximumValue()
    {
        return max($this->sequence);
    }

    public function countElements()
    {
        return count($this->sequence);
    }

    public function getAverageValue()
    {
        $total = $this->countElements();

        return number_format(array_sum($this->sequence) / $this->countElements(), 6);
    }

}
