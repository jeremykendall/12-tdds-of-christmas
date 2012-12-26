<?php

namespace Tdd;

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
