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
 * RecentlyUsedList (LIFO)
 *
 * @package TwelveTddsOfChristmas\Day6
 */
class RecentlyUsedList implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * @var int Current array position
     */
    private $position;

    /**
     * @var array LIFO list
     */
    protected $list;

    /**
     * Public constructor
     */
    public function __construct()
    {
        $this->position = 0;
        $this->list = array();
    }

    /**
     * Gets all list items
     *
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Pushes item onto LIFO stack
     *
     * @param mixed $item Item to push onto stack
     */
    public function push($item)
    {
        if (is_null($item) || $item == '') {
            throw new \InvalidArgumentException('Cannot add null values or empty strings.');
        }

        if ($this->search($item) !== false) {
            $this->offsetUnset($this->search($item));
        }

        array_unshift($this->list, $item);
    }

    /**
     * Is stack empty
     *
     * @return bool True if empty, false if not empty
     */
    public function isEmpty()
    {
        return empty($this->list);
    }

    /**
     * Peeks at top value
     *
     * @return mixed Top item on stack
     */
    public function top()
    {
        return $this->list[0];
    }

    /**
     * Sets value at offset
     *
     * @param int   $offset Offset
     * @param mixed $value  Value to set at offset
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->push($value);

            return;
        }

        if ($this->search($value) !== false) {
            $this->offsetUnset($this->search($value));
        }

        array_splice($this->list, $offset, 0, array($value));
    }

    /**
     * Tests whether or not offset exists
     *
     * @param  int  $offset Offset to test
     * @return bool True if offset exists, false otherwise
     */
    public function offsetExists($offset)
    {
        return isset($this->list[$offset]);
    }

    /**
     * Unsets item at offset
     *
     * @param int $offset Offset to unset
     */
    public function offsetUnset($offset)
    {
        unset($this->list[$offset]);
    }

    /**
     * Gets item at offset
     *
     * @param  int   $offset Offset
     * @return mixed Item value at offset
     */
    public function offsetGet($offset)
    {
        return isset($this->list[$offset]) ? $this->list[$offset] : null;
    }

    /**
     * Counts items in stack
     *
     * @return int Count of items in stack
     */
    public function count()
    {
        return count($this->list);
    }

    /**
     * Resets stack counter to 0
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Returns item at current index
     *
     * @return mixed Item at current index
     */
    public function current()
    {
        return $this->list[$this->position];
    }

    /**
     * Returns current array position
     *
     * @return int Current array position
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Increments array position
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Tests if current array position is set
     *
     * @return bool True if position is set, false otherwise
     */
    public function valid()
    {
        return isset($this->list[$this->position]);
    }

    /**
     * Searchs list for item
     *
     * @param  mixed     $item Needle
     * @return int|false Offset if item found, false otherwise
     */
    protected function search($item)
    {
        return array_search($item, $this->list);
    }

}
