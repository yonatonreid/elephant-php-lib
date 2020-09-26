<?php


declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffAssocTest extends AbstractTestCase
{
    public function testCanDiffSimple()
    {
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "yellow", "red");
        $expected = array('b' => 'brown', 'c' => 'blue');
        $this -> assertEquals($expected, Arrays ::arrayDiff($array1, $array2));
    }

    public function testCanDiffComplex()
    {
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "yellow", "red");
        $array3 = array("b" => "brown");
        $expected = array('c' => 'blue');
        $this -> assertEquals($expected, Arrays ::arrayDiff($array1, $array2, $array3));
    }

    public function testCanDiffNumericIndex()
    {
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "yellow");
        $expected = array('b' => 'brown', 'c' => 'blue', 0 => 'red');
        $this -> assertEquals($expected, Arrays ::arrayDiff($array1, $array2));
    }
}