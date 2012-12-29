<?php

/**
 * 12 TDDs of Christmas
 *
 * @link      http://github.com/jeremykendall/12-tdds-of-christmas for the canonical source repository
 * @copyright Copyright (c) 2012 Jeremy Kendall (http://about.me/jeremykendall)
 * @license   http://github.com/jeremykendall/12-tdds-of-christmas/blob/master/LICENSE MIT License
 * @see       http://www.wiredtothemoon.com/2012/12/12-tdds-of-christmas/ 12 TDDs of Chrismas blog post
 */

namespace Tdd;

/**
 * MontyHall class provides the ability to run simulations of the Monty Hall
 * problem
 *
 * @package TwelveTddsOfChristmas\Day4
 * @see http://en.wikipedia.org/wiki/Monty_Hall_problem Monty Hall Problem
 */
class MontyHall
{
    /**
     * @var array The three doors
     */
    protected $doors;

    const CONTESTANT_SWITCH_CHOICE = 1;
    const CONTESTANT_NOT_SWITCH_CHOICE = 0;

    /**
     * Runs the Monty Hall problem scenario
     *
     * @param  int $contestantDecision Constant determining contestant behavior
     * @return int Array key from $this->doors representing contestant choice
     */
    public function runScenario($contestantDecision)
    {
        $contestantChoice = $this->contestantChooseDoor();

        if ($contestantDecision === self::CONTESTANT_NOT_SWITCH_CHOICE) {
            return $contestantChoice;
        }

        $hostChoice = $this->hostChooseGoat($contestantChoice);

        return $this->contestantSwitchChoice($contestantChoice, $hostChoice);
    }

    /**
     * Contestant's initial random choice of doors
     *
     * @return int Array key of random door choice
     */
    public function contestantChooseDoor()
    {
        return array_rand($this->doors);
    }

    public function hostChooseGoat($contestantChoice)
    {
        // Remove contestant's choice from host's choices
        $remainingDoors = array_diff_key($this->doors, array($contestantChoice => null));
        // Gets array of all $doors keys with value of 'goat'
        $goats = array_keys($remainingDoors, 'goat');

        return $goats[array_rand($goats)];
    }

    public function contestantSwitchChoice($contestantChoice, $hostChoice)
    {
        $remainingDoor = array_diff_key($this->doors, array($contestantChoice => null, $hostChoice => null));

        return key($remainingDoor);
    }

    public function isWinningChoice($choice)
    {
        return $this->doors[$choice] == 'car';
    }

    public function setDoors(array $doors)
    {
        $this->doors = $doors;
    }

}
