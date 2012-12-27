<?php

namespace Tdd;

class NumberNames
{
    protected $unique = array(
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

            $temp = $this->getHundreds($padded);
            $temp .= $this->getTens(substr($padded, 1));

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

    protected function getHundreds($hundreds)
    {
        $string = null;

        if ($hundreds[0]) {
            $string = $this->unique[$hundreds[0]] . ' hundred';
        }

        if ($string && ltrim(substr($hundreds, 1), '0')) {
            $string .= ' and ';
        }

        return $string;
    }

    public function getTens($tens)
    {
        if (array_key_exists($tens, $this->unique)) {
            return $this->unique[$tens];
        }

        $temp = null;

        if ($tens[0] > 0) {
            $temp .= $this->unique[$tens[0] * 10] . ' ';
        }

        if ($tens[1] > 0) {
            $temp .= $this->unique[$tens[1]];
        }

        return $temp;
    }

}
