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
 * Hand represents a poker hand
 *
 * @package TwelveTddsOfChristmas\Day11
 */
class Hand
{
    /**
     * @var array Cards in poker hand
     */
    protected $cards;

    /**
     * @var array Values of rank as integers
     */
    protected $rankValues;

    /**
     * @var array Rank names
     */
    protected $rankNames;

    /**
     * @var array Bonus points based on hand type
     */
    protected $handBonuses;

    /**
     * Public constructor
     *
     * @param array $cards Playing cards making up a poker hand
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;

        $this->rankValues = array(
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
            'J' => 11,
            'Q' => 12,
            'K' => 13,
            'A' => 14
        );

        $this->rankNames = array(
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
            'J' => 'Jack',
            'Q' => 'Queen',
            'K' => 'King',
            'A' => 'Ace'
        );

        $this->handBonuses = array(
            'One pair' => 100,
            'Two pair' => 200,
            'Three of a kind' => 300,
            'Straight' => 400,
            'Flush' => 500,
            'Full house' => 600,
            'Four of a kind' => 700,
            'Straight flush' => 800,
            'Royal flush' => 1000
        );
    }

    /**
     * Score the poker hand
     *
     * @returns int Score
     */
    public function score()
    {
        $score = array_sum($this->getCardsValues());
        $bonus = @$this->handBonuses[$this->identifyHand()];

        if (strpos($this->identifyHand(), 'High') === 0) {
            $score += (max($this->getCardsValues()) * 2);
        }

        return $score + $bonus;
    }

    /**
     * Finds the name of the poker hand
     *
     * @return string Poker hand name
     */
    public function identifyHand()
    {
        if ($this->isRoyalFlush()) {
            return 'Royal flush';
        }

        if ($this->isStraightFlush()) {
            return 'Straight flush';
        }

        if ($this->isFourOfAKind()) {
            return 'Four of a kind';
        }

        if ($this->isFullHouse()) {
            return 'Full house';
        }

        if ($this->isFlush()) {
            return 'Flush';
        }

        if ($this->isStraight()) {
            return 'Straight';
        }

        if ($this->isThreeOfAKind()) {
            return 'Three of a kind';
        }

        if ($this->isTwoPair()) {
            return 'Two pair';
        }

        if ($this->isOnePair()) {
            return 'One pair';
        }

        return 'High card';
    }

    /**
     * Tests hand identity
     *
     * @return bool True if royal flush, false otherwise
     */
    public function isRoyalFlush()
    {
        if ($this->isStraight() &&
            $this->isFlush() &&
            max($this->getCardsValues()) == 14
            && min($this->getCardsValues()) == 10) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if straight flush, false otherwise
     */
    public function isStraightFlush()
    {
        if ($this->isStraight() && $this->isFlush()) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if four of a kind, false otherwise
     */
    public function isFourOfAKind()
    {
        if (max($this->cardsCountRanks()) == 4) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if full house, false otherwise
     */
    public function isFullHouse()
    {
        if (count($this->cardsCountRanks()) == 2 &&
            max($this->cardsCountRanks()) == 3) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if flush, false otherwise
     */
    public function isFlush()
    {
        if (count($this->getSuits()) == 1) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if straight, false otherwise
     */
    public function isStraight()
    {
        if (count($this->cardsCountRanks()) == 5 &&
            max($this->getCardsValues()) - 4 == min($this->getCardsValues())) {
            return true;
        }

        if ($this->getRanks() == array(2, 3, 4, 5, 'A')) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if Three of a kind, false otherwise
     */
    public function isThreeOfAKind()
    {
        if (count($this->cardsCountRanks()) == 3 &&
            max($this->cardsCountRanks()) == 3) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if Two pair, false otherwise
     */
    public function isTwoPair()
    {
        if (count($this->cardsCountRanks()) == 3 &&
            max($this->cardsCountRanks()) == 2) {
            return true;
        }

        return false;
    }

    /**
     * Tests hand identity
     *
     * @return bool True if One pair, false otherwise
     */
    public function isOnePair()
    {
        if (count($this->cardsCountRanks()) == 4) {
            return true;
        }

        return false;
    }

    /**
     * Gets high card in hand
     *
     * @return string High card
     */
    public function getHighCard()
    {
        $ranks = $this->getRanks();
        $highCard = max(array_keys($ranks));

        return $this->rankNames[$ranks[$highCard]];
    }

    /**
     * Gets ranks of cards in hands, dropping suits
     *
     * @return array Ranks of cards in hand, dropping suits
     */
    public function getRanks()
    {
        $ranks = array();

        foreach ($this->cards as $card) {
            $ranks[] = substr($card, 0, strlen($card) - 1);
        }

        usort($ranks, $this->sortRanks());

        return $ranks;
    }

    /**
     * Gets the unique suits that make up the hand. Suits are sorted and array
     * keys are not preserved.
     *
     * @return array Unique, sorted suits making up hand
     */
    public function getSuits()
    {
        $suits = array();

        foreach ($this->cards as $card) {
            $suits[] = substr($card, -1);
        }

        sort($suits);

        // Returns unique values, keys are not preserved
        return array_values(array_unique($suits));
    }

    /**
     * Gets the point value of each card in hand by rank
     *
     * @return array Values of array are point values of each card by rank
     */
    public function getCardsValues()
    {
        $values = array();
        $ranks = $this->getRanks();

        foreach ($ranks as $rank) {
            $values[] = $this->rankValues[$rank];
        }

        return $values;
    }

    /**
     * Counts the frequency of ranks in this hand
     *
     * @return array Keys are card ranks, values are frequency of those ranks
     */
    public function cardsCountRanks()
    {
        return array_count_values($this->getRanks());
    }

    /**
     * Sort function that sorts ranks from low to high
     *
     * @return Closure Sort function that sorts ranks from low to high
     */
    public function sortRanks()
    {
        $rankValues = $this->rankValues;

        return function ($a, $b) use ($rankValues) {
            return $rankValues[$a] - $rankValues[$b];
        };
    }

    /**
     * Creates hand from string
     *
     * @param string String representing a poker hand
     * @return Hand Instance of Hand
     */
    public static function fromString($string)
    {
        $cards = explode(' ', $string);

        return new Hand($cards);
    }

    /**
     * Gets rank names
     *
     * @return array Rank names
     */
    public function getRankNames()
    {
        return $this->rankNames;
    }

    /**
     * Gets rank values
     *
     * @return array Rank values
     */
    public function getRankValues()
    {
        return $this->rankValues;
    }
}
