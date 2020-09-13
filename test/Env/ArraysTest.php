<?php

declare(strict_types=1);

namespace ElephantTest\Env;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;


class ArraysTest extends TestCase
{
    public function testArrayChangeKeyCaseCanBeLower(){
        $actual = ['FOO'=>1,'BAR'=>2,'BAZ'=>3];
        $expected = ['foo'=>1,'bar'=>2,'baz'=>3];
        $this->assertEquals($expected,Arrays::arrayChangeKeyCase($actual,CASE_LOWER));
    }

    public function testArrayChangeKeyCaseCanBeUpper(){
        $actual = ['foo'=>1,'bar'=>2,'baz'=>3];
        $expected = ['FOO'=>1,'BAR'=>2,'BAZ'=>3];
        $this->assertEquals($expected,Arrays::arrayChangeKeyCase($actual,CASE_UPPER));
    }
}