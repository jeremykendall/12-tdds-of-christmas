<?php

/**
 * 12 TDDs of Christmas
 *
 * @link      http://github.com/jeremykendall/12-tdds-of-christmas for the canonical source repository
 * @copyright Copyright (c) 2012 Jeremy Kendall (http://about.me/jeremykendall)
 * @license   http://github.com/jeremykendall/12-tdds-of-christmas/blob/master/LICENSE MIT License
 * @see       http://www.wiredtothemoon.com/2012/12/12-tdds-of-christmas/ 12 TDDs of Chrismas blog post
 */

namespace Tdd\Poker;

/**
 * Game is a poker game simulator
 *
 * @package TwelveTddsOfChristmas\Day11
 */
class Game
{
    /**
     * @var array Poker players
     */
    protected $players;

    /**
     * @var array Hand rankings
     */
    protected $handRankings = array(
        'High card',
        'One pair',
        'Two pair',
        'Three of a kind',
        'Straight',
        'Flush',
        'Full house',
        'Four of a kind',
        'Straight flush',
        'Royal flush'
    );

    /**
     * Public constructor
     *
     * @param array $players Poker players
     */
    public function __construct(array $players)
    {
        $this->players = $players;
    }

    /**
     * Players show their hands and a winner is determined
     *
     * @return string Winner and their winning hand
     */
    public function showdown()
    {
        $format = '%s wins - %s';

        usort($this->players, $this->sortPlayersByHand($this->handRankings));
        $winner = $this->players[0];

        $matchingHands = $this->findMatchingHands($winner['hand']);

        if (!empty($matchingHands)) {

            $winner = $this->compareMatchingHands($matchingHands);

            if ($winner == 'Tie') {
                return $winner;
            }

            return sprintf(
                $format,
                $winner['name'],
                $winner['hand']->identifyHand() . ': ' . $winner['highCard']
            );
        }

        return sprintf(
            $format,
            $winner['name'],
            $winner['hand']->identifyHand()
        );
    }

    public function findMatchingHands($hand)
    {
        $hands = array();
        $matchingHands = array();

        foreach ($this->players as $player) {
            $hands[$player['name']] = $player['hand']->identifyHand();
        }

        $handCount = array_count_values($hands);

        if ($handCount[$hand->identifyHand()] > 1) {
            foreach ($this->players as $player) {
                if ($player['hand']->identifyHand() == $hand->identifyHand()) {
                    $matchingHands[$player['name']] = $player['hand'];
                }
            }
        }

        return $matchingHands;
    }

    /**
     * Sort function to sort players by rank of their poker hand
     *
     * @param  array   $handRankings Relative ranking of poker hands
     * @return Closure Sort function to sort players by rank of their poker hand
     */
    public function sortPlayersByHand(array $handRankings)
    {
        return function ($a, $b) use ($handRankings) {
            $rankings = array_flip($handRankings);

            if ($rankings[$a['hand']->identifyHand()] == $rankings[$b['hand']->identifyHand()]) {
                return 0;
            }

            return ($rankings[$b['hand']->identifyHand()] < $rankings[$a['hand']->identifyHand()]) ? -1 : 1;
        };
    }

    /**
     * Compares matching poker hands to see which actually wins
     *
     * @param  array $matchingHands Player and hand array
     * @return array Winning player and hand
     */
    public function compareMatchingHands(array $matchingHands)
    {
        $compare = array();

        foreach ($matchingHands as $hand) {
            $compare = array_merge($compare, $hand->getCardsValues());
        }

        $result = array_filter(array_count_values($compare), function ($var) {
            if ($var != 1) {
                return false;
            }

            return true;
        });

        if (empty($result)) {
            return 'Tie';
        }

        $final = array();

        foreach ($matchingHands as $player => $hand) {
            $search = array_search(max(array_keys($result)), $hand->getCardsValues());
            if ($search !== false) {
                $value = max(array_keys($result));
                $ranks = array_flip($hand->getRankValues());
                $rank = $ranks[$value];
                $rankNames = $hand->getRankNames();
                $rankName = $rankNames[$rank];
                $final = array(
                    'name' => $player,
                    'hand' => $hand,
                    'highCard' => $rankName
                );
                break;
            }
        }

        return $final;
    }
}
