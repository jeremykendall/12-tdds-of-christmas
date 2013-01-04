<?php

class PhoneNumbersTest extends \PHPUnit_Framework_TestCase
{
    protected $illegalPrefixes = array();

    protected function setUp()
    {
        $this->illegalPrefixes = array(
            0,
            00,
            011,
            01,
            211,
            311,
            411,
            511,
            611,
            711,
            811,
            830,
            911,
            958,
            9580,
            998
        );
    }
}
