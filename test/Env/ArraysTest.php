<?php

declare(strict_types=1);

namespace ElephantTest\Env;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;
use TypeError;

class ArraysTest extends TestCase
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

    public function testArrayChangeKeyCaseRecursiveDefaultsLower(){
        $actual = ['FOO' => ['I' => 1, 'Z' => 2, 'A' => ['B' => 3, 'C' => 4]], 'BAR' => 2, 'BAZ' => 3];
        $expected = ['foo' => ['i' => 1, 'z' => 2, 'a' => ['b' => 3, 'c' => 4]], 'bar' => 2, 'baz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseRecursive($actual));
    }

    public function testArrayChangeKeyCaseUnicodeThrowsExceptionWhenNotArray()
    {
        $this -> expectException(TypeError::class);
        $actual = "notAnArray";
        Arrays ::arrayChangeKeyCaseUnicode($actual);
    }

    public function testArrayChangeKeyCaseUnicodeReturnsLower()
    {
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => "sugar");
        $actual = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => "sugar");
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual, CASE_LOWER));
    }

    public function testArrayChangeKeyCaseUnicodeReturnsUpper()
    {
        $actual = array("FirSt" => 1, "yağ" => "Oil", "şekER" => "sugar");
        $expected = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => "sugar");
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual, CASE_UPPER));
    }

    public function testArrayChangeKeyCaseUnicodeDefaultsLower()
    {
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => "sugar");
        $actual = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => "sugar");
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual));
    }
}