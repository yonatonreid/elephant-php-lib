<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use TypeError;

class ArrayChangeKeyCaseRecursiveTest extends AbstractTestCase
{
    public function testArrayIsEmpty()
    {
        $expected = array();
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseRecursive(array()));
    }

    public function testArrayChangeKeyCaseRecursiveReturnsLower()
    {
        $actual = ['FOO' => ['I' => 1, 'Z' => 2, 'A' => ['B' => 3, 'C' => 4]], 'BAR' => 2, 'BAZ' => 3];
        $expected = ['foo' => ['i' => 1, 'z' => 2, 'a' => ['b' => 3, 'c' => 4]], 'bar' => 2, 'baz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseRecursive($actual, CASE_LOWER));
    }

    public function testArrayChangeKeyCaseRecursiveReturnsUpper()
    {
        $expected = ['FOO' => ['I' => 1, 'Z' => 2, 'A' => ['B' => 3, 'C' => 4]], 'BAR' => 2, 'BAZ' => 3];
        $actual = ['Foo' => ['I' => 1, 'z' => 2, 'A' => ['b' => 3, 'c' => 4]], 'bAR' => 2, 'BAz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseRecursive($actual, CASE_UPPER));
    }

    public function testArrayChangeKeyCaseRecursiveDefaultsLower()
    {
        $actual = ['FOO' => ['I' => 1, 'Z' => 2, 'A' => ['B' => 3, 'C' => 4]], 'BAR' => 2, 'BAZ' => 3];
        $expected = ['foo' => ['i' => 1, 'z' => 2, 'a' => ['b' => 3, 'c' => 4]], 'bar' => 2, 'baz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseRecursive($actual));
    }

    public function testArrayChangeKeyCaseRecursiveThrowsExceptionWhenNotArray()
    {
        $this -> expectException(TypeError::class);
        $actual = "notAnArray";
        Arrays ::arrayChangeKeyCaseRecursive($actual);
    }

    public function testArrayChangeKeyCaseRecursivePreservesNumericalIndexes()
    {
        $actual = ['foo' => 1, 1 => 'two', 3 => ['bar' => 1, 2 => 'BAZ'], 'baz' => 'TEST'];
        $expected = ['FOO' => 1, 1 => 'two', 3 => ['BAR' => 1, 2 => 'BAZ'], 'BAZ' => 'TEST'];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseRecursive($actual, CASE_UPPER));
    }
}