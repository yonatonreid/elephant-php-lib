<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;
use TypeError;

class ArrayChangeKeyCaseUnicodeTest extends TestCase
{
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

    public function testArrayChangeKeyCaseUnicodeThrowsExceptionWithNumericIndex()
    {
        $this -> expectException(TypeError::class);
        $expected = array('first' => 1, 2 => "Oil", "şeker" => "sugar");
        Arrays ::arrayChangeKeyCaseUnicode($expected);
    }

}