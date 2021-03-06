<?php

namespace Tdd\Test;

use Tdd\MontyHall;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-29 at 01:18:57.
 */
class MontyHallTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MontyHall
     */
    protected $montyHall;

    /**
     * @var array Doors with prizes
     */
    protected $doors = array('car', 'goat', 'goat');

    /**
     * @var int How many times to run the simulation
     */
    protected $simulations;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->montyHall = new MontyHall();
        $this->montyHall->setDoors($this->doors);
        $this->simulations = 1000;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->montyHall = null;
    }

    /**
     * Tests probability of winning car approaches 2/3 when contestant switches 
     * doors
     */
    public function testContestantDoesSwitchScenario()
    {
        $wins = 0;

        for ($i = 0; $i <= $this->simulations; $i++) {
            shuffle($this->doors);
            $this->montyHall->setDoors($this->doors);
            $choice = $this->montyHall->runScenario(MontyHall::CONTESTANT_SWITCH_CHOICE);
            if ($this->montyHall->isWinningChoice($choice)) {
                $wins++;
            }
        }

        $this->assertGreaterThanOrEqual(0.63, $this->getWinProbability($wins, $this->simulations));
    }

    /**
     * Tests probability of winning a car should approach 1/3 if contestant 
     * does not switch doors
     */
    public function testContestantDoesNotSwitchScenario()
    {
        $wins = 0;

        for ($i = 0; $i <= $this->simulations; $i++) {
            shuffle($this->doors);
            $this->montyHall->setDoors($this->doors);
            $choice = $this->montyHall->runScenario(MontyHall::CONTESTANT_NOT_SWITCH_CHOICE);
            if ($this->montyHall->isWinningChoice($choice)) {
                $wins++;
            }
        }

        $this->assertLessThanOrEqual(0.37, $this->getWinProbability($wins, $this->simulations));
    }

    protected function getWinProbability($wins, $simulations)
    {
        return $wins / $simulations;
    }

    /**
     * @dataProvider doorChoiceDataProvider
     */
    public function testHostChooseGoat($contestantChoice)
    {
        $hostChoice = $this->montyHall->hostChooseGoat($contestantChoice);
        $this->assertNotEquals($contestantChoice, $hostChoice);
        $this->assertEquals('goat', $this->doors[$hostChoice]);
    }

    /**
     * @dataProvider switchChoiceDataProvider
     */
    public function testContestantSwitchChoice($contestantChoice, $hostChoice, $switchChoice)
    {
        $this->assertEquals($switchChoice, $this->montyHall->contestantSwitchChoice($contestantChoice, $hostChoice));
    }

    /**
     * @dataProvider isWinningChoiceDataProvider
     */
    public function testIsWinningChoice($choice, $isWinningChoice)
    {
        $this->assertEquals($isWinningChoice, $this->montyHall->isWinningChoice($choice));
    }

    public function doorChoiceDataProvider()
    {
        return array(
            array(0),
            array(1),
            array(2)
        );
    }

    public function switchChoiceDataProvider()
    {
        return array(
            array(0, 1, 2),
            array(1, 2, 0),
            array(2, 0, 1)
        );
    }

    public function isWinningChoiceDataProvider()
    {
        return array(
            array(0, true),
            array(1, false),
            array(2, false)
        );
    }
}
