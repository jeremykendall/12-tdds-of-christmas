<?php

namespace Tdd\Test\Poker;

use Tdd\Poker\Hand;

class HandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider handProvider
     */
    public function testScoreHand($cards, $score, $ranks, $suits, $name)
    {
        $hand = new Hand($cards);
        $this->assertEquals($score, $hand->score());
    }

    /**
     * @dataProvider handProvider
     */
    public function testGetRanks($cards, $score, $ranks, $suits, $name)
    {
        $hand = new Hand($cards);
        $this->assertEquals($ranks, $hand->getRanks());
    }

    /**
     * @dataProvider handProvider
     */
    public function testGetSuits($cards, $score, $ranks, $suits, $name)
    {
        $hand = new Hand($cards);
        $this->assertEquals($suits, $hand->getSuits());
    }

    /**
     * @dataProvider handProvider
     */
    public function testIdentifyHand($cards, $score, $ranks, $suits, $name)
    {
        $hand = new Hand($cards);
        $this->assertEquals($name, $hand->identifyHand());
    }

    /**
     * @dataProvider highCardProvider
     */
    public function testGetHighCard($cards, $highCard)
    {
        $hand = new Hand($cards);
        $this->assertEquals($highCard, $hand->getHighCard());
    }

    /**
     * @dataProvider fromStringProvider
     */
    public function testFromString($string, $hand)
    {
        $fromString = Hand::fromString($string);
        $this->assertEquals($hand, $fromString);
    }

    public function highCardProvider()
    {
        return array(
            array(array('2H', '3H', '7D', '6C', '4S'), '7'),
            array(array('10H', 'KH', '7D', 'AD', 'QS'), 'Ace'),
            array(array('10H', '10D', '7D', '7C', 'QS'), 'Queen'),
        );
    }

    public function fromStringProvider()
    {
        return array(
            array(
                '2H 3H 7D 6C 4S', 
                new Hand(array('2H', '3H', '7D', '6C', '4S'))
            ),
            array(
                '10H KH 7D AD QS', 
                new Hand(array('10H', 'KH', '7D', 'AD', 'QS'))
            ),
            array(
                '10H 10D 7D 7C QS', 
                new Hand(array('10H', '10D', '7D', '7C', 'QS'))
            ),
            array(
                '2H 4S 4C 2D 4H', 
                new Hand(array('2H', '4S', '4C', '2D', '4H'))
            ),
        );
    }

    public function handProvider()
    {
        return array(
            array(
                array('2H', '3H', '7D', '6C', '4S'), 
                36, 
                array(2, 3, 4, 6, 7), 
                array('C', 'D', 'H', 'S'),
                'High card'
            ),
            array(
                array('10H', 'KH', '7D', 'AD', 'QS'), 
                84, 
                array(7, 10, 'Q', 'K', 'A'),
                array('D', 'H', 'S'),
                'High card'
            ),
            array(
                array('10H', '10D', '7D', 'AD', 'QS'), 
                153, 
                array(7, 10, '10', 'Q', 'A'),
                array('D', 'H', 'S'),
                'One pair'
            ),
            array(
                array('10H', '10D', '7D', '7C', 'QS'), 
                246,
                array(7, 7, 10, 10, 'Q'),
                array('C', 'D', 'H', 'S'),
                'Two pair'
            ),
            array(
                array('2H', '2D', '2C', '7C', 'QS'),
                325,
                array(2, 2, 2, 7, 'Q'),
                array('C', 'D', 'H', 'S'),
                'Three of a kind'
            ),
            array(
                array('2H', '3H', '4H', '5S', '6H'),
                420,
                array(2, 3, 4, 5, 6),
                array('H', 'S'),
                'Straight'
            ),
            array(
                array('AC', '2H', '3H', '4H', '5H'),
                428,
                array(2, 3, 4, 5, 'A'),
                array('C', 'H'),
                'Straight'
            ),
            array(
                array('2H', '3H', '4H', '10H', '6H'),
                525,
                array(2, 3, 4, 6, 10),
                array('H'),
                'Flush'
            ),
            array(
                array('2H', '2C', '3H', '2D', '3D'),
                612,
                array(2, 2, 2, 3, 3),
                array('C', 'D', 'H'),
                'Full house'
            ),
            array(
                array('2H', '4S', '4C', '2D', '4H'),
                616,
                array(2, 2, 4, 4, 4),
                array('C', 'D', 'H', 'S'),
                'Full house'
            ),
            array(
                array('9H', '9C', '9S', '9D', '7D'),
                743,
                array(7, 9, 9, 9, 9),
                array('C', 'D', 'H', 'S'),
                'Four of a kind'
            ),
            array(
                array('2H', '3H', '4H', '5H', '6H'),
                820,
                array(2, 3, 4, 5, 6),
                array('H'),
                'Straight flush'
            ),
            array(
                array('10S', 'JS', 'QS', 'KS', 'AS'),
                1060,
                array(10, 'J', 'Q', 'K', 'A'),
                array('S'),
                'Royal flush'
            ),
        );
    }
}
