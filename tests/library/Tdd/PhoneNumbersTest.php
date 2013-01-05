<?php

namespace Tdd;

class PhoneNumbersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PhoneNumber 
     */
    protected $phoneNumber;

    protected function setUp()
    {
        $this->phoneNumber = new PhoneNumber();
    }

    protected function tearDown()
    {
        $this->phoneNumber = null;
    }

    public function testEmptyListThrowsException()
    {
        $this->setExpectedException('\Exception', 'The phone list must have at least one entry');
        $this->phoneNumber->isConsistent(array());
    }

    /**
     * @dataProvider isConsistentDataProvider
     */
    public function testIsConsistent($list, $expected)
    {
        $this->assertEquals($expected, $this->phoneNumber->isConsistent($list));
    }

    public function isConsistentDataProvider()
    {
        return array(
            array(array('91 12 54 26', '97 625 992', '911'), false),
            array(array('41 12 54 26', '97 625 992', '411'), false),
            array(array('97 625 992'), true),
            array(array('9580', '95 809 997', '411'), false),
            array(array('41 12 54 26', '97 625 992', '982 09 2879 0'), true),
        );
    }
}
