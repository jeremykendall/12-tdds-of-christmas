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
 * Range deals with a range of numbers
 *
 * @package TwelveTddsOfChristmas\Day8
 */
class Range
{
    /**
     * @var int Range minimum
     */
    protected $min;

    /**
     * @var int Range maximum
     */
    protected $max;

    /**
     * @var array Range
     */
    protected $range;

    /**
     * Public constructor
     *
     * @param int $min Range minimum
     * @param int $max Range maximum
     */
    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;

        if (is_null($min) && is_null($max)) {
            $this->range = array();
        }

        $this->range = range($min, $max);

        if (max($this->range) != $max) {
            throw new \Exception('Range must step by 1');
        }
    }

    /**
     * Does range contain the given value?
     *
     * @param  int  $value Value to test for containment
     * @return bool True if value is contained in range, false otherwise
     */
    public function contains($value)
    {
        return ($value >= $this->min() && $value <= $this->max());
    }

    /**
     * Calculates intersection of ranges
     *
     * @param Range $range Range to compare against
     * @returns Range An instance of Range containing the intersection of ranges
     */
    public function intersect(Range $range)
    {
        $intersect = array_intersect($this->range, $range->getRange());

        if (empty($intersect)) {
            return new Range();
        }

        return new Range(min($intersect), max($intersect));
    }

    /**
     * Gets range minimin
     *
     * @return int Range minimum
     */
    public function min()
    {
        return min($this->range);
    }

    /**
     * Gets range maximum
     *
     * @return int Range maximum
     */
    public function max()
    {
        return max($this->range);
    }

    /**
     * Gets range
     *
     * @return array Range
     */
    public function getRange()
    {
        return $this->range;
    }
}
