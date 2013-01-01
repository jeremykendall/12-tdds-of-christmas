<?php

namespace Tdd;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-26 at 11:19:39.
 */
class CalcStatsTest extends \PHPUnit_Framework_TestCase
{
    public static function calcStatsProvider()
    {
        // stats, min, max, count, average
        return array(
            array(new CalcStats(array(6, 9, 15, -2, 92, 11)), -2, 92, 6, 21.833333),
        );
    }

    /**
     * @dataProvider calcStatsProvider
     */
    public function testGetMinimumValue($stats, $min, $max, $count, $average)
    {
        $this->assertEquals($min, $stats->getMinimumValue());
    }

    /**
     * @dataProvider calcStatsProvider
     */
    public function testGetMaximumValue($stats, $min, $max, $count, $average)
    {
        $this->assertEquals($max, $stats->getMaximumValue());
    }

    /**
     * @dataProvider calcStatsProvider
     */
    public function testCountElements($stats, $min, $max, $count, $average)
    {
        $this->assertEquals($count, $stats->countElements());
    }

    /**
     * @dataProvider calcStatsProvider
     */
    public function testGetAverageValue($stats, $min, $max, $count, $average)
    {
        $this->assertEquals($average, $stats->getAverageValue());
    }
}
