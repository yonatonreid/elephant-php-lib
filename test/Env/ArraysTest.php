<?php

declare(strict_types=1);

namespace ElephantTest\Env;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;
use TypeError;

class ArraysTest extends TestCase
{
    public function testArrayChangeKeyCaseDefaultsLower(){
        $actual=['FOO'=>1,'bar'=>2,'BaZ'=>3];
        $expected=['foo'=>1,'bar'=>2,'baz'=>3];
        $this->assertEquals($expected,Arrays::arrayChangeKeyCase($actual));
    }

    public function testArrayChangeKeyCaseReturnsLower(){
        $actual = ['FOO'=>1,'BAR'=>2,'BAZ'=>3];
        $expected = ['foo'=>1,'bar'=>2,'baz'=>3];
        $this->assertEquals($expected,Arrays::arrayChangeKeyCase($actual,CASE_LOWER));
    }

    public function testArrayChangeKeyCaseReturnsUpper(){
        $actual = ['foo'=>1,'bar'=>2,'baz'=>3];
        $expected = ['FOO'=>1,'BAR'=>2,'BAZ'=>3];
        $this->assertEquals($expected,Arrays::arrayChangeKeyCase($actual,CASE_UPPER));
    }
    
    public function testArrayChangeKeyCaseThrowsExceptionWhenNotArray(){
        $this->expectException(TypeError::class);
        $actual="notAnArray";
        Arrays::arrayChangeKeyCase($actual);
    }

    public function testArrayChangeKeyCaseUnicodeThrowsExceptionWhenNotArray(){
        $this->expectException(TypeError::class);
        $actual="notAnArray";
        Arrays::arrayChangeKeyCaseUnicode($actual);
    }

    public function testArrayChangeKeyCaseUnicodeReturnsLower(){
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => "sugar");
        $actual = array("FIRST"=>1,"YAĞ"=>"Oil","ŞEKER"=>"sugar");
        $this->assertEquals($expected,Arrays::arrayChangeKeyCaseUnicode($actual,CASE_LOWER));
    }

    public function testArrayChangeKeyCaseUnicodeReturnsUpper(){
        $actual = array("FirSt" => 1, "yağ" => "Oil", "şekER" => "sugar");
        $expected = array("FIRST"=>1,"YAĞ"=>"Oil","ŞEKER"=>"sugar");
        $this->assertEquals($expected,Arrays::arrayChangeKeyCaseUnicode($actual,CASE_UPPER));
    }

    public function testArrayChangeKeyCaseUnicodeDefaultsLower(){
        $expected = array("first" => 1, "yağ" => "Oil", "şeker" => "sugar");
        $actual = array("FIRST"=>1,"YAĞ"=>"Oil","ŞEKER"=>"sugar");
        $this->assertEquals($expected,Arrays::arrayChangeKeyCaseUnicode($actual));
    }
}