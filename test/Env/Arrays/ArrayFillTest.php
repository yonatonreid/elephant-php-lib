<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;

class ArrayFillTest extends \ElephantTest\Env\AbstractTestCase
{
    public function testCanFillArray()
    {
        $expected = [5 => 'banana', 6 => 'banana', 7 => 'banana', 8 => 'banana', 9 => 'banana', 10 => 'banana'];
        $this -> assertEquals($expected, Arrays ::arrayFill(5, 6, 'banana'));
    }

    public function testCanFillNegative()
    {
        $expected = [-2 => 'banana', 0 => 'banana', 1 => 'banana', 2 => 'banana', 3 => 'banana', 4 => 'banana'];
        $this -> assertEquals($expected, Arrays ::arrayFill(-2, 6, 'banana'));
    }

    public function testCanFillNegativeFixIndices()
    {
        $expected = [-2 => 'banana', -1 => 'banana', 0 => 'banana', 1 => 'banana', 2 => 'banana', 3 => 'banana', 4 => 'banana'];
        $this -> assertEquals($expected, Arrays ::arrayFill(-2, 6, 'banana', true));
    }
}