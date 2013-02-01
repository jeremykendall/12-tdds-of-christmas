<?php

namespace Tdd\Test;

use Tdd\RecentlyUsedList;

class RecentlyUsedListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RecentlyUsedList
     */
    protected $list;

    protected function setUp()
    {
        $this->list = new RecentlyUsedList();
        $this->list->push('first');
        $this->list->push('second');
        $this->list->push('third');
    }

    public function testListInitiallyEmpty()
    {
        $empty = new RecentlyUsedList();
        $this->assertTrue($empty->isEmpty());
    }

    public function testLastInIsFirstOut()
    {
        $this->assertEquals('third', $this->list->top());
    }

    public function testAddingDuplicateItemMovesItemToTopOfList()
    {
        $this->assertEquals(3, count($this->list));

        $this->list->push('second');

        // Ensure 'second' is the first item in the list
        $this->assertEquals('second', $this->list->top());
        // Ensure that second only shows up in the list once
        $this->assertEquals(1, count(array_keys($this->list->getList(), 'second')));
        // Ensure that there are still only 3 items in the list
        $this->assertEquals(3, count($this->list));
    }

    public function testAddingDuplicateItemWithOffsetSetMovesItemToTopOfList()
    {
        $this->assertEquals(3, count($this->list));

        $this->list->offsetSet(null, 'second');

        // Ensure 'second' is the first item in the list
        $this->assertEquals('second', $this->list->top());
        // Ensure that second only shows up in the list once
        $this->assertEquals(1, count(array_keys($this->list->getList(), 'second')));
        // Ensure that there are still only 3 items in the list
        $this->assertEquals(3, count($this->list));
    }

    public function testAddingDuplicateItemWithOffsetSet()
    {
        $this->assertEquals(3, count($this->list));

        $this->list->offsetSet(2, 'second');
        $this->assertEquals('second', $this->list->offsetGet(2));

        // Ensure 'third' is still the first item in the list
        $this->assertEquals('third', $this->list->top());
        // Ensure that second only shows up in the list once
        $this->assertEquals(1, count(array_keys($this->list->getList(), 'second')));
        // Ensure that there are still only 3 items in the list
        $this->assertEquals(3, count($this->list));
    }
    public function testAddingNullValueThrowsException()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Cannot add null values or empty strings.');
        $this->list->push(null);
    }

    public function testAddingEmptyStringThrowsException()
    {
        $this->setExpectedException('\InvalidArgumentException', 'Cannot add null values or empty strings.');
        $this->list->push('');
    }

    public function testIteratorIsLifo()
    {
        $expected = array('third', 'second', 'first');
        $i = 0;
        foreach($this->list as $item) {
            $this->assertEquals($expected[$i], $item);
            $i++;
        }
    }

    /**
     * This test ensures the ArrayAccess methods are working as expected
     *
     * offsetSet() has some logic behind it, so that is tested in other tests as 
     * well as here.
     */
    public function testArrayAccessMethods()
    {
        $this->assertEquals('third', $this->list[0]);
        $this->assertEquals(3, count($this->list));

        unset($this->list[0]);
        $this->assertEquals(2, count($this->list));

        $this->list->offsetSet(2, 'new');
        $this->assertEquals('new', $this->list[2]);
        $this->assertEquals(3, count($this->list));
        
        $this->list->offsetSet(null, 'zing!');
        $this->assertEquals(4, count($this->list));
        $this->assertEquals('zing!', $this->list->top());
        
        $this->assertTrue($this->list->offsetExists(2));
        
        $this->list->rewind();
        $this->assertEquals(0, $this->list->key());
        $this->list->next();
        $this->assertEquals(1, $this->list->key());
    }

}
