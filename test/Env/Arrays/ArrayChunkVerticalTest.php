<?php


declare(strict_types=1);

namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayChunkVerticalTest extends AbstractTestCase
{
    public function testCreatesFiveArraysFromFiveElementsWithOneSize()
    {
        $actual = range(1, 5);
        $expected = [[1], [2], [3], [4], [5]];
        $this -> assertEquals($expected, Arrays ::arrayChunkVertical($actual, 1));
    }

    public function testCanChunkVertically()
    {
        $actual = range(1, 31);
        $expected = [
            [1, 6, 11, 16, 20, 24, 28],
            [2, 7, 12, 17, 21, 25, 29],
            [3, 8, 13, 18, 22, 26, 30],
            [4, 9, 14, 19, 23, 27, 31],
            [5, 10, 15]
        ];
        $this -> assertEquals($expected, Arrays ::arrayChunkVertical($actual, 7));
    }
}