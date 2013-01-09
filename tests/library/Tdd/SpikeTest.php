<?php

namespace Tdd;

class SpikeTest extends \PHPUnit_Framework_TestCase
{
	protected $spike;

	protected function setUp()
	{
		$this->spike = new Spike();
	}

	protected function tearDown()
	{
		$this->spike = null;
	}

	/**
	 * @dataProvider spikeProvider
	 */
	public function testSpikeParseArray()
	{
		$expected = array('alpha' => 9);
		$array = array('alpha' => array(14, 9, 7, 3, 6), 'bravo' => array(14, 8, 3, 2, 5));
		$this->assertEquals($expected, $this->spike->parseArray($array));
	}

	public function spikeProvider()
	{
		return array(
			array(array('alpha' => array(14, 9, 7, 3, 6), 'bravo' => array(14, 8, 3, 2, 5)), array('alpha' => 9)),
			array(array('alpha' => array(14, 9, 7, 3, 6), 'bravo' => array(14, 8, 3, 2, 5), 'charlie' => array(10, 14, 3, 2, 4)), array('charlie' => 10)),
		);
	}

}
