<?php


namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDeleteRecursiveTest extends AbstractTestCase
{
    public function testCanDeleteRecursive()
    {
        $arr = [0 => 'a', 1 => ['c' => 'a'], 2 => 'b', 3 => [0 => 'a']];
        $this -> assertEquals([2 => 'b'], Arrays ::arrayDeleteRecursive($arr, 'a'));
    }

    public function testCanDeleteRecursiveContainsNonEmptyDimensions()
    {
        $arr = [0 => 'a', 1 => ['c' => 'a'], 2 => 'b', 3 => [0 => 'a', 1 => 'b']];
        $this -> assertEquals([2 => 'b', 3 => [1 => 'b']], Arrays ::arrayDeleteRecursive($arr, 'a'));
    }
}