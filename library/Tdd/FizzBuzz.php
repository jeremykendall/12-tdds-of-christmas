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
 * FizzBuzz satisfies the requirements of the Fizz Buzz test
 *
 * @link http://c2.com/cgi/wiki?FizzBuzzTest Explanation of Fizz Buzz at c2.com
 * @package TwelveTddsOfChristmas\Day5
 */
class FizzBuzz
{

    /**
     * Returns Fizz if multiple of 3, Buzz if multiple of 5, FizzBuzz if multiple
     * of 3 and 5. Returns $number if none of those conditions are met.
     *
     * @param  int   $number
     * @return mixed int if not multiple of 3 or 5, string otherwise
     */
    public function of($number)
    {
        $result = null;

        if ($number % 3 == 0) {
            $result = 'Fizz';
        }

        if ($number % 5 == 0) {
            $result .= 'Buzz';
        }

        if (!$result) {
            $result = $number;
        }

        return $result;
    }

}
