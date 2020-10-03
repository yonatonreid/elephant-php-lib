<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffAssocTest extends AbstractTestCase
{
    public function testCanDiff()
    {
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "yellow", "red");
        $expected = ['b' => 'brown', 'c' => 'blue', 0 => 'red'];
        $this -> assertEquals($expected, Arrays ::arrayDiffAssoc($array1, $array2));
    }

    public function testStrictStringEquals()
    {
        $array1 = array(0, 1, 2);
        $array2 = array("00", "01", "2");
        $expected = [0 => 0, 1 => 1];
        $this -> assertEquals($expected, Arrays ::arrayDiffAssoc($array1, $array2));
    }

    public function testDuplicates()
    {
        $array1 = array(0 => "a", 1 => "b", 2 => "c", 3 => "a", 4 => "a");
        $array2 = array(0 => "a");
        $expected = array(1 => "b", 2 => "c", 3 => "a", 4 => "a");
        $this -> assertEquals($expected, Arrays ::arrayDiffAssoc($array1, $array2));
    }
}