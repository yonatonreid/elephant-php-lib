<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;
use TypeError;

class ArrayChangeKeyCaseTest extends TestCase
{
    public function testArrayChangeKeyCaseDefaultsLower()
    {
        $actual = ['FOO' => 1, 'bar' => 2, 'BaZ' => 3];
        $expected = ['foo' => 1, 'bar' => 2, 'baz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCase($actual));
    }

    public function testArrayChangeKeyCaseReturnsLower()
    {
        $actual = ['FOO' => 1, 'BAR' => 2, 'BAZ' => 3];
        $expected = ['foo' => 1, 'bar' => 2, 'baz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCase($actual, CASE_LOWER));
    }

    public function testArrayChangeKeyCaseReturnsUpper()
    {
        $actual = ['foo' => 1, 'bar' => 2, 'baz' => 3];
        $expected = ['FOO' => 1, 'BAR' => 2, 'BAZ' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCase($actual, CASE_UPPER));
    }

    public function testArrayChangeKeyCaseThrowsExceptionWhenNotArray()
    {
        $this -> expectException(TypeError::class);
        $actual = "notAnArray";
        Arrays ::arrayChangeKeyCase($actual);
    }

    public function testArrayChangeKeyCasePreservesNumericalIndexes()
    {
        $actual = ['foo' => 1, 1 => 'two', 3 => 'Bar', 'baz' => 'TEST'];
        $expected = ['FOO' => 1, 1 => 'two', 3 => 'Bar', 'BAZ' => 'TEST'];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCase($actual, CASE_UPPER));
    }
}