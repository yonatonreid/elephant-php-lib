<?php


namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArraySliceTest extends AbstractTestCase
{
    public function testCanSliceArray()
    {
        $input = array("a", "b", "c", "d", "e");

        $expected = ['c', 'd', 'e'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, 2));

        $expected = ['d'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, -2, 1));

        $expected = ['a', 'b', 'c'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, 0, 3));
    }

    public function testCanSliceArrayPreservesKeys()
    {
        $input = array("a", "b", "c", "d", "e");

        $expected = [2 => 'c', 3 => 'd', 4 => 'e'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, 2, null, true));

        $expected = [3 => 'd'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, -2, 1, true));

        $expected = [0 => 'a', 1 => 'b', 2 => 'c'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, 0, 3, true));
    }

    public function testOneBasedArray()
    {
        $input = array(1 => "a", "b", "c", "d", "e");
        $expected = [0 => 'b', 1 => 'c'];
        $this -> assertEquals($expected, Arrays ::arraySlice($input, 1, 2));
    }

    public function testMixedKeys()
    {
        $ar = array('a' => 'apple', 'b' => 'banana', '42' => 'pear', 'd' => 'orange');

        $expected = ['a' => 'apple', 'b' => 'banana', 0 => 'pear'];
        $this -> assertEquals($expected, Arrays ::arraySlice($ar, 0, 3));

        $expected = ['a' => 'apple', 'b' => 'banana', 42 => 'pear'];
        $this -> assertEquals($expected, Arrays ::arraySlice($ar, 0, 3, true));
    }
}