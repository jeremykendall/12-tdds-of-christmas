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
 * PhoneNumber checks lists of numbers for consistency. Consistency is defined as
 * no complete number being the same as the prefix/start of another number in
 * the list.
 *
 * @package TwelveTddsOfChristmas\Day10
 */
class PhoneNumber
{

    /**
     * Checks phone list for consistency
     *
     * @param  array      $list List of numbers to check for consistency
     * @return bool       True if consistent, false otherwise
     * @throws \Exception Throws exception if list is empty
     */
    public function isConsistent(array $list)
    {
        $this->validateNotEmpty($list);

        $list = $this->filterList($list);

        foreach ($list as $number) {
            foreach ($list as $test) {
                if ($number == $test) {
                    continue;
                }

                if (!$this->validateIsConsistent($number, $test)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Removes all characters excepting integers from each number in the list
     *
     * (Thanks to @tjlytle for the filter_var() idea)
     *
     * @param  array $list List of numbers
     * @return array Filtered list
     */
    protected function filterList(array $list)
    {
        array_walk($list, function(&$number, $key) {
            $number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
        });

        return $list;
    }

    /**
     * Throws exception if list is empty
     *
     * @param  array      $list List of numbers
     * @throws \Exception Throws exception if list is empty
     */
    protected function validateNotEmpty(array $list)
    {
        if (empty($list)) {
            throw new \Exception('The phone list must have at least one entry');
        }
    }

    /**
     * Tests consistency
     *
     * @param  string $a String to test
     * @param  string $b String to test
     * @return bool   True if neither string appears in the other, false otherwise
     */
    protected function validateIsConsistent($a, $b)
    {
        return (strpos($a, $b) !== 0 && strpos($b, $a) !== 0);
    }
}
