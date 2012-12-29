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
 * The MineField class stores and provides info about the provided minefield map:
 *
 * @package TwelveTddsOfChristmas\Day3
 */
class MineField
{

    /**
     * @var array Minefield map
     */
    protected $map;

    /**
     * @var int Map row count
     */
    protected $rows;

    /**
     * @var int Map column count
     */
    protected $columns;

    /**
     * Public constructor
     *
     * @param string $data Minefield data
     */
    public function __construct($data)
    {
        $dataArray = explode("\n", $data);
        $rowsAndColumns = explode(' ', $dataArray[0]);

        $this->rows = $rowsAndColumns[0];
        $this->columns = $rowsAndColumns[1];

        unset($dataArray[0]);

        $map = array();

        // max y coordinate
        $y = $this->rows - 1;

        foreach ($dataArray as $row) {
            // Using $y to set appropriate y coordinate (reverse of what the
            // array keys would otherwise be)
            $map[$y] = str_split($row);
            $y--;
        }

        $this->map = $map;
    }

    /**
     * Returns string representation of the hint field
     *
     * @return string String representation of hint field
     */
    public function getHintField()
    {
        return $this->hintFieldToString($this->generateHintField());
    }

    /**
     * Generates a hint map from the minefield map
     *
     * @return array Hint field
     */
    protected function generateHintField()
    {
        $hintField = array();

        foreach ($this->map as $y => $row) {
            foreach ($row as $x => $node) {
                if ($this->map[$y][$x] == '*') {
                    $hintField[$y][$x] = $this->map[$y][$x];
                    continue;
                }

                $hintField[$y][$x] = $this->countAdjacentMines($x, $y);
            }
        }

        return $hintField;
    }

    /**
     * Returns string representation of the hint field
     *
     * @param  array  $hintField Hint field
     * @return string String representation of hint field
     */
    protected function hintFieldToString(array $hintField)
    {
        $temp = array();

        foreach ($hintField as $row) {
            $temp[] = implode('', $row);
        }

        return implode("\n", $temp);
    }

    /**
     * Counts mines adjacent to node identified by x, y coordinates
     *
     * @param  int $x X coordinate
     * @param  int $y Y coordinate
     * @return int Count of mines adjacent to node
     */
    protected function countAdjacentMines($x, $y)
    {
        $adjacentMineCount = 0;
        $adjacentNodeList = $this->findAdjacentNodes($x, $y);

        foreach ($adjacentNodeList as $node) {
            $x = $node['x'];
            $y = $node['y'];
            if ($this->map[$y][$x] == '*') {
                $adjacentMineCount++;
            }
        }

        return $adjacentMineCount;
    }

    /**
     * Finds nodes adjacent to node identified by x, y coordinates
     *
     * @param  int   $x X coordinate
     * @param  int   $y Y coordinate
     * @return array Array of adjacent nodes
     */
    public function findAdjacentNodes($x, $y)
    {
        $node = array(
            'x' => $x,
            'y' => $y
        );

        if (!$this->isValidNode($node)) {
            throw new \Exception("'$x, $y' is not a valid set of coordinates");
        }

        $candidates = array(
            'north' => array('x' => $x, 'y' => $y + 1),
            'north-east' => array('x' => $x +1, 'y' => $y + 1),
            'east' => array('x' => $x + 1, 'y' => $y),
            'south-east' => array('x' => $x + 1, 'y' => $y - 1),
            'south' => array('x' => $x, 'y' => $y - 1),
            'south-west' => array('x' => $x - 1, 'y' => $y - 1),
            'west' => array('x' => $x - 1, 'y' => $y),
            'north-west' => array('x' => $x - 1, 'y' => $y + 1),
        );

        $adjacentNodeList = array_filter($candidates, array($this, 'isValidNode'));

        return $adjacentNodeList;
    }

    /**
     * Tests node to see if it exists in map
     *
     * @param  array $node Associative array containing x and y map coordinates
     * @return bool  True if node exists in map, false otherwise
     */
    public function isValidNode(array $node)
    {
        $x = $node['x'];
        $y = $node['y'];

        if (array_key_exists($y, $this->map) && array_key_exists($x, $this->map[$y])) {
            return true;
        }

        return false;
    }

    /**
     * Gets map row count
     *
     * @return int Row count
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Gets map column count
     *
     * @return int Column count
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Gets minefield map
     *
     * @return array Minefield map
     */
    public function getMap()
    {
        return $this->map;
    }
}
