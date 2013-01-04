<?php

namespace Tdd\Range;

class RangeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider rangeDataProvider
     */
    public function testRangeMin($min, $max, $contained, $isContained) {
        $range = new Range($min, $max);
        $this->assertEquals($min, $range->min());
    }
    
    /**
     * @dataProvider rangeDataProvider
     */
    public function testRangeMax($min, $max, $contained, $isContained) {
        $range = new Range($min, $max);
        $this->assertEquals($max, $range->max());
    }

    /**
     * @dataProvider rangeDataProvider
     */
    public function testIncludes($min, $max, $candidate, $isContained) {
        $range = new Range($min, $max);
        $this->assertEquals($isContained, $range->contains($candidate));
    }

    public function testEmptyRange()
    {
        $range = new Range();
        $this->assertInstanceOf('Tdd\Range\EmptyRange', $range);
        $this->assertInternalType('array', $range->getRange());
        $this->assertEmpty($range->getRange());
    }

    /**
     * @dataProvider intersectDataProvider
     */
    public function testRangeIntersect($range1, $range2, $rangeIntersect)
    {
        $this->assertEquals($rangeIntersect, $range1->intersect($range2));
    }

    public function rangeDataProvider()
    {
        return array(
            array(1, 10, 11, false),
            array(-12, 52, -5, true),
            array(10, 923, 10, true)
        );
    }

    public function intersectDataProvider()
    {
        return array(
            array(new Range(10, 20), new Range(15, 25), new Range(15, 20)),
            array(new Range(-12, 37), new Range(31, 33), new Range(31, 33)),
            array(new Range(10, 20), new Range(95, 225), new Range(15, 20)),
        );
    }
}
