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
 * NumberNames will return the English language equivalent of a provided
 * integer
 *
 * @package TwelveTddsOfChristmas\Day2
 */
class NumberNames
{
    /**
     * @var array English integer equivalents
     */
    protected $dictionary = array(
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
        'ten',
        'eleven',
        'twelve',
        'thirteen',
        'fourteen',
        'fifteen',
        'sixteen',
        'seventeen',
        'eighteen',
        'nineteen',
        'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety'
    );

    /**
     * @var array English number unit names
     */
    protected $units = array(
        2 => 'thousand',
        3 => 'million'
    );

    /**
     * Converts an integer to its English language equivalent.
     *
     * Example: 310 would become three hundred and ten.
     *
     * @param  int    $integer Integer to convert
     * @return string English language equivalent of provided integer
     */
    public function convert($integer)
    {
        if ($integer == 0) {
            return 'zero';
        }

        $name = array();
        $numbers = explode(',', number_format($integer));
        $count = count($numbers);

        foreach ($numbers as $number) {
            $padded = sprintf('%03d', $number);

            $hundreds = $this->getHundreds($padded);
            $tens = $this->getTens(substr($padded, 1));

            $temp = $hundreds . $tens;

            if ($hundreds && $tens) {
                $temp = $hundreds . ' and ' . $tens;
            }

            if ($count > 1) {
                $temp .= ' ' . $this->units[$count];
            }

            $count--;

            if ($temp) {
                $name[] = $temp;
            }
        }

        return implode(', ', $name);
    }

    /**
     * Converts the hundreds place into English words
     *
     * @param  int    $hundreds Three digit integer
     * @return string Hundreds number in English in the form of 'n hundred'
     */
    protected function getHundreds($hundreds)
    {
        $string = null;

        if ($hundreds[0]) {
            $string = $this->dictionary[$hundreds[0]] . ' hundred';
        }

        return $string;
    }

    /**
     * Converts the tens numbers into English words
     *
     * @param  int    $tens Two digit integer
     * @return string Tens in English. Can be one - ninety nine
     */
    protected function getTens($tens)
    {
        if (array_key_exists($tens, $this->dictionary)) {
            return $this->dictionary[$tens];
        }

        $temp = null;

        if ($tens[0] > 0) {
            $temp .= $this->dictionary[$tens[0] * 10] . ' ';
        }

        if ($tens[1] > 0) {
            $temp .= $this->dictionary[$tens[1]];
        }

        return $temp;
    }

}
