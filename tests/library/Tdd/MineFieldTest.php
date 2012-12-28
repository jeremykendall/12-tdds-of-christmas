<?php

namespace Tdd;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-28 at 07:38:23.
 */
class MineFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MineField
     */
    protected $mineField;

    /**
     * @todo   Implement testGetHintField().
     */
    public function testGetHintField()
    {
        $map = <<<'EOT'
3 4
*...
..*.
....
EOT;

        $expected = <<<'EOT'
*211
12*1
0111
EOT;
        $mineField = new MineField($map);
        $this->assertEquals($expected, $mineField->getHintField());
    }
}
