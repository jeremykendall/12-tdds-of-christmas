<?php

namespace Tdd\Range;

class EmptyRangeTest extends \PHPUnit_Framework_TestCase
{

    protected $emptyRange;

    protected function setUp()
    {
        $this->emptyRange = new EmptyRange();
    }

    protected function tearDown()
    {
        $this->emptyRange = null;
    }

    public function testRangeMin() {
        $this->assertNull($this->emptyRange->min());
    }
    
    public function testRangeMax() {
        $this->assertNull($this->emptyRange->max());
    }

    public function testContains()
    {
        $this->assertFalse($this->emptyRange->contains(12));
    }

    public function testEmptyRange()
    {
        $this->assertInternalType('array', $this->emptyRange->getRange());
        $this->assertEmpty($this->emptyRange->getRange());
    }

}
