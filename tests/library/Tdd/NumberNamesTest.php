<?php

namespace Tdd;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-26 at 11:42:32.
 */
class NumberNamesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NumberNames
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new NumberNames();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }

    /**
     * @dataProvider convertDataProvider
     */
    public function testConvert($integer, $string)
    {
        $this->assertEquals($string, $this->object->convert($integer));
    }

public function convertDataProvider()
    {
        return array(
            array(0, 'zero'),
            array(5, 'five'),
            array(12, 'twelve'),
            array(67, 'sixty seven'),
            array(99, 'ninety nine'),
            array(300, 'three hundred'),
            array(804, 'eight hundred and four'),
            array(220, 'two hundred and twenty'),
            array(645, 'six hundred and forty five'),
            array(118, 'one hundred and eighteen'),
            array(1000, 'one thousand'),
            array(1501, 'one thousand, five hundred and one'),
            array(12609, 'twelve thousand, six hundred and nine'),
            array(512607, 'five hundred and twelve thousand, six hundred and seven'),
            array(43112603, 'forty three million, one hundred and twelve thousand, six hundred and three')
        );
    }
}
