<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use ArgumentCountError;
use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use \ErrorException;

class ArrayChunkTest extends AbstractTestCase
{
    public function testSizeMustBeGreaterThanZero(){
        $this->expectException(ErrorException::class);
        $this->assertEquals(array(),Arrays::arrayChunk(array(),0));
    }

    public function testCanChunkArrayWithoutPreservingKeys()
    {
        $actual = array('a', 'b', 'c', 'd', 'e');
        $expected = [[0 => 'a', 1 => 'b'], [0 => 'c', 1 => 'd'], [0 => 'e']];
        $this -> assertEquals($expected, Arrays ::arrayChunk($actual, 2));
    }

    public function testCanChunkArrayWithPreservingKeys()
    {
        $actual = array('a', 'b', 'c', 'd', 'e');
        $expected = [[0 => 'a', 1 => 'b'], [2 => 'c', 3 => 'd'], [4 => 'e']];
        $this -> assertEquals($expected, Arrays ::arrayChunk($actual, 2, true));
    }

    public function testCannotChunkWithSizeNotInputted()
    {
        $this -> expectException(ArgumentCountError::class);
        $actual = array('a', 'b', 'c', 'd', 'e');
        Arrays ::arrayChunk($actual);
    }
}