<?php

namespace Tdd;

class MineField
{
    /**
     * @var string
     */
    protected $map;

    /**
     * @var int
     */
    protected $rows;

    /**
     * @var int
     */
    protected $columns;

    /**
     * Public constructor
     *
     * @param string Minefield map
     */
    public function __construct($map)
    {
        $this->map = $map;
    }

    /**
     * Generates a hint map from the minefield map
     *
     * @return string Hint field
     */
    public function getHintField()
    {
        return null;
    }

}
