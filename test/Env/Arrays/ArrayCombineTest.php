<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use ErrorException;

class ArrayCombineTest extends AbstractTestCase
{
    public function testUnequalSizesThrowsErrorException()
    {
        $this -> expectException(ErrorException::class);
        $this -> expectErrorMessage("array_combine(): Both parameters should have an equal number of elements");
        $a = array('green', 'red', 'yellow');
        $b = array('avocado', 'apple');
        Arrays ::arrayCombine($a, $b);
    }

    public function testCanCombine()
    {
        $expected = ['green' => 'avocado', 'red' => 'apple', 'yellow' => 'banana'];

        $a = array('green', 'red', 'yellow');
        $b = array('avocado', 'apple', 'banana');
        $this -> assertEquals($expected, Arrays ::arrayCombine($a, $b));
    }

    public function testSameKeysReturnsLatter()
    {
        $expected = ['a' => 2, 'b' => 3];

        $a = array('a', 'a', 'b');
        $b = array(1, 2, 3);
        $this -> assertEquals($expected, Arrays ::arrayCombine($a, $b));
    }

    public function testCanKeepValues()
    {
        $a = array('a', 'a', 'b');
        $b = array(1, 2, 3);

        $expected = ['a' => [1, 2], 'b' => 3];
        $this -> assertEquals($expected, Arrays ::arrayCombine($a, $b, true));
    }

    public function testCanCallEmptyArrays()
    {
        $a = array();
        $b = array();
        $expected = array();
        $this -> assertEquals($expected, Arrays ::arrayCombine($a, $b));
    }
}