<?php

/**
 * 12 TDDs of Christmas
 *
 * @link      http://github.com/jeremykendall/12-tdds-of-christmas for the canonical source repository
 * @copyright Copyright (c) 2012 Jeremy Kendall (http://about.me/jeremykendall)
 * @license   http://github.com/jeremykendall/12-tdds-of-christmas/blob/master/LICENSE MIT License
 * @see       http://www.wiredtothemoon.com/2012/12/12-tdds-of-christmas/ 12 TDDs of Chrismas blog post
 */

namespace Tdd\Range;

/**
 * Range deals with a range of numbers
 *
 * @package TwelveTddsOfChristmas\Day8
 */
interface RangeInterface
{

    /**
     * Does range contain the given value?
     *
     * @param  int  $value Value to test for containment
     * @return bool True if value is contained in range, false otherwise
     */
    public function contains($value);

    /**
     * Calculates intersection of ranges
     *
     * @param Range $range Range to compare against
     * @returns Range An instance of Range containing the intersection of ranges
     */
    public function intersect(Range $range);

    /**
     * Gets range minimin
     *
     * @return int Range minimum
     */
    public function min();

    /**
     * Gets range maximum
     *
     * @return int Range maximum
     */
    public function max();

    /**
     * Gets range
     *
     * @return array Range
     */
    public function getRange();
}
