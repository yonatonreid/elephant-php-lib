<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use TypeError;

class ArrayChangeKeyCaseUnicodeTest extends AbstractTestCase
{
    public function testArrayIsEmpty()
    {
        $expected = array();
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode(array()));
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
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual, MB_CASE_LOWER));
    }

    public function testArrayChangeKeyCaseUnicodeReturnsUpper()
    {
        $actual = array("FirSt" => 1, "yağ" => "Oil", "şekER" => "sugar");
        $expected = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => "sugar");
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual, MB_CASE_UPPER));
    }

    public function testArrayChangeKeyCaseUnicodeDefaultsLower()
    {
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => "sugar");
        $actual = array("FIRST" => 1, "YAĞ" => "Oil", "ŞEKER" => "sugar");
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual));
    }

    public function testArrayChangeKeyCaseUnicodeThrowsExceptionWithNumericIndex()
    {
        $this -> expectException(TypeError::class);
        $expected = array('first' => 1, 2 => "Oil", "şeker" => "sugar");
        Arrays ::arrayChangeKeyCaseUnicode($expected);
    }

    public function testArrayChangeKeyCaseUnicodeReturnsTitle()
    {
        $expected = ['Foo' => 1, 'Bar' => 2, 'Baz' => 3];
        $actual = ['foO' => 1, 'bAR' => 2, 'BAZ' => 3];
        $this -> assertEquals($expected, Arrays ::arrayChangeKeyCaseUnicode($actual, MB_CASE_TITLE));
    }
}