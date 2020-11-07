<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use http\Exception\InvalidArgumentException;

class ArrayFillKeysTest extends AbstractTestCase
{
    public function testCanFillKeys()
    {
        $keys = array('foo', 5, 10, 'bar');
        $expected = array('foo' => 'banana', 5 => 'banana', 10 => 'banana', 'bar' => 'banana');
        $this -> assertEquals($expected, Arrays ::arrayFillKeys($keys, 'banana'));
    }

    public function testStringNumericBecomesInteger()
    {
        $a = array("1");
        $expected = array(1 => "test");
        $this -> assertEquals($expected, Arrays ::arrayFillKeys($a, "test"));
    }

    public function testAssociativeArray()
    {
        $array1 = array("a" => "first", "b" => "second", "c" => "something", "red");
        $array2 = array("a" => "first", "b" => "something", "letsc");
        $fill = array('a' => 'first', 'b' => 'something', 0 => 'letsc');
        $expected = array('first' => $fill, 'second' => $fill, 'something' => $fill, 'red' => $fill);
        $this -> assertEquals($expected, Arrays ::arrayFillKeys($array1, $array2));
    }

    public function testCanIntersect()
    {
        $arr1 = array(0 => 'abc', 1 => 'def');
        $arr2 = array(0 => 452, 1 => 128);
        $expected = array('abc' => 452, 'def' => 128);
        $this -> assertEquals($expected, Arrays ::arrayFillKeys($arr1, $arr2, true));
    }

    public function testThrowsExceptionOnNonArrayIntersection()
    {
        $this -> markTestIncomplete("Install exthttp");
        $this -> expectException(InvalidArgumentException::class);
        $this -> expectErrorMessage("Both keys and value must be arrays for intersection");
        $arr1 = array(0 => 'abc', 1 => 'def');
        $val = "someNonArray";
        Arrays ::arrayFillKeys($arr1, $val, true);
    }
}