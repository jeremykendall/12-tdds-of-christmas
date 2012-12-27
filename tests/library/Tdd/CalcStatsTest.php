<?php
namespace Tdd;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-26 at 11:19:39.
 */
class CalcStatsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CalcStats
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new CalcStats(array(6, 9, 15, -2, 92, 11));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }

    public function testGetMinimumValue()
    {
        $this->assertEquals(-2, $this->object->getMinimumValue());
    }

    public function testGetMaximumValue()
    {
        $this->assertEquals(92, $this->object->getMaximumValue());
    }

    public function testCountElements()
    {
        $this->assertEquals(6, $this->object->countElements());
    }

    public function testGetAverageValue()
    {
        $this->assertEquals(21.833333, $this->object->getAverageValue());
    }
}
