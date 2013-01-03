<?php

namespace Tdd;

class BowlingGameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BowlingGame
     */
    protected $game;

    protected function setUp()
    {
        $this->game = new BowlingGame();
    }

    protected function tearDown()
    {
        $this->game = null;
    }

    protected function rollMany($rolls, $pins)
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->game->roll($pins);
        }
    }

    protected function rollSpare($first, $second)
    {
        $this->game->roll($first);
        $this->game->roll($second);
    }

    protected function rollStrike()
    {
        $this->game->roll(10);
    }

    public function testGutterGame()
    {
        $this->rollMany(20, 0); 
        $this->assertEquals(0, $this->game->score());
    }

    public function testAllOnes()
    {
        $this->rollMany(20, 1);
        $this->assertEquals(20, $this->game->score());
    }

    public function testOneSpare()
    {
        $this->rollSpare(5, 5);
        $this->game->roll(3);
        $this->rollMany(17, 0);
        $this->assertEquals(16, $this->game->score());
    }

    public function testOneStrike()
    {
        $this->rollStrike();
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(16, 0);
        $this->assertEquals(24, $this->game->score());
    }

    public function testPerfectGame()
    {
        $this->rollMany(12, 10);
        $this->assertEquals(300, $this->game->score());
    }

    public function testThreeStrikes()
    {
        $this->rollStrike();
        $this->rollStrike();
        $this->rollStrike();
        $this->assertEquals(60, $this->game->score());
    }

	public function testAllNines()
	{
		$this->rollMany(10, 9);
		$this->assertEquals(90, $this->game->score());
	}

    public function testStrikeThenTwoGutters()
    {
        $this->rollStrike();
        $this->rollMany(2, 0);
        $this->assertEquals(10, $this->game->score());
    }

    /**
     * @group simulation
     */
    public function testGameSimulation()
    {
        $this->rollStrike();
        $this->rollSpare(7, 3);
        $this->game->roll(7);
        $this->game->roll(2);
        $this->rollSpare(9, 1);
        $this->rollStrike();
        $this->rollStrike();
        $this->rollStrike();
        $this->game->roll(2);
        $this->game->roll(3);
        $this->rollSpare(6, 4);
        $this->rollSpare(7, 3);
        $this->game->roll(3);
        $this->assertEquals(168, $this->game->score());
    }

}
