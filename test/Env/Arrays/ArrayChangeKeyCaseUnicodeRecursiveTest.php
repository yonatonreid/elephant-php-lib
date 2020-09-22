<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;
use TypeError;

class ArrayChangeKeyCaseUnicodeRecursiveTest extends TestCase
{

    public function testArrayChangeKeyCaseUnicodeRecursiveThrowsExceptionWhenNotArray()
    {
        $this -> expectException(TypeError::class);
        $actual = "notAnArray";
        Arrays ::arrayChangeKeyUnicodeRecursive($actual);
    }

    public function testArrayChangeKeyCaseUnicodeRecursiveThrowsExceptionWithNumericIndex()
    {
        $this -> expectException(TypeError::class);
        $expected = array('first' => 1, 2 => ["yağ" => "Oil"], "şeker" => "sugar");
        Arrays ::arrayChangeKeyUnicodeRecursive($expected);
    }

    public function testArrayChangeKeyCaseUnicodeRecursiveReturnsLower()
    {
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => ["yağ" => "sugar"]);
        $actual = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => ["YAĞ" => "sugar"]);
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyUnicodeRecursive($actual, MB_CASE_LOWER));
    }

    public function testArrayChangeKeyCaseUnicodeRecursiveReturnsUpper()
    {
        $actual = array("first" => 1, "yağ" => "Oil", "şeker" => ["yağ" => "sugar"]);
        $expected = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => ["YAĞ" => "sugar"]);
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyUnicodeRecursive($actual, MB_CASE_UPPER));
    }

    public function testArrayChangeKeyCaseUnicodeRecursiveDefaultsLower()
    {
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => ["yağ" => "sugar"]);
        $actual = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => ["YAĞ" => "sugar"]);
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyUnicodeRecursive($actual));
    }

    public function testArrayChangeKeyCaseUnicodeRecursiveReturnsTitle()
    {
        $expected = ['Foo' => 1, 'Bar' => 2, 'Atc' => ['Yet' => 2, 'Ask' => 3], 'Baz' => 3];
        $actual = ['foo' => 1, 'bAr' => 2, 'aTC' => ['yet' => 2, 'ask' => 3], 'bAz' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyUnicodeRecursive($actual, MB_CASE_TITLE));
    }
}