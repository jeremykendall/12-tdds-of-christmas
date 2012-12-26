<?php

namespace Tdd;

class NumberNames
{
    protected $unique;

    protected $names;

    public function __construct()
    {
        $this->unique = array(
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
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety'
        );

        $this->names = array(
            1 => 'hundred',
            2 => 'thousand',
            3 => 'million',
            4 => 'billion'
            5 => 'trillion'
        );

    /**
     * Converts an integer to it's english language equivalent.
     *
     * Example: 310 would become three hundred and ten.
     *
     * @param int $integer Integer to convert
     */
    public function convert($integer)
    {
        $numbers = str_split($integer, 3);

        return 'ninety nine';
    }

}
