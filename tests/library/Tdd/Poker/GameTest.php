<?php

namespace Tdd\Poker;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider showdownProvider
     */
    public function testShowdown($players, $winner)
    {
        $game = new Game($players);
        $this->assertEquals($winner, $game->showdown());
    }

    /**
     * @group compare
     */
    public function testCompareMatchingHands()
    {
        $players = array(
            array(
                'name' => 'Black',
                'hand' => Hand::fromString('2H 3D 5S 9C KD')
            ),
            array(
                'name' => 'White',
                'hand' => Hand::fromString('2C 3H 4S 8C AH')
            )
        );

        $game = new Game($players);

        $matchingHands = array();

        foreach ($players as $player) {
            $matchingHands[$player['name']] = $player['hand'];
        }

        $expected = array(
            'name' => 'White',
            'hand' => $players[1]['hand'],
            'highCard' => 'Ace'
        );

        $result = $game->compareMatchingHands($matchingHands);
        $this->assertEquals($expected, $result);
    }

    public function showdownProvider()
    {
        return array(
            array(
                array(
                    array(
                        'name' => 'Black',
                        'hand' => Hand::fromString('2H 3D 5S 9C KD')
                    ),
                    array(
                        'name' => 'White',
                        'hand' => Hand::fromString('2C 3H 4S 8C AH')
                    )
                ),
                'White wins - High card: Ace'
            ),
            array(
                array(
                    array(
                        'name' => 'Black',
                        'hand' => Hand::fromString('2H 4S 4C 2D 4H')
                    ),
                    array(
                        'name' => 'White',
                        'hand' => Hand::fromString('2S 8S AS QS 3D')
                    )
                ),
                'Black wins - Full house'
            ),
            array(
                array(
                    array(
                        'name' => 'Black',
                        'hand' => Hand::fromString('2H 3D 5S 9C KD')
                    ),
                    array(
                        'name' => 'White',
                        'hand' => Hand::fromString('2C 3H 4S 8C KH')
                    )
                ),
                'Black wins - High card: 9'
            ),
            array(
                array(
                    array(
                        'name' => 'Black',
                        'hand' => Hand::fromString('2H 3D 5S 9C KD')
                    ),
                    array(
                        'name' => 'White',
                        'hand' => Hand::fromString('2C 3H 4S 8C KH')
                    )
                ),
                'Black wins - High card: 9'
            ),
        );
    }

}
