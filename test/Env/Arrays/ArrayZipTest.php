<?php
declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use InvalidArgumentException;

class ArrayZipTest extends AbstractTestCase
{
    public function testCanZip()
    {
        $arr = ['a' => 'apple', 'b' => 'banana', 'c' => 'corn', 'd' => 'devilseggs'];
        Arrays ::arrayZip($arr, ":");
        $expected = ['a' => 'a:apple', 'b' => 'b:banana', 'c' => 'c:corn', 'd' => 'd:devilseggs'];
        $this -> assertEquals($expected, $arr);
    }

    public function testThrowsException()
    {
        $this -> markTestSkipped("Install exthttp");
        $this -> expectException(InvalidArgumentException::class);
        $this -> expectErrorMessage("First parameter must be an array");
        $var = 1;
        Arrays ::arrayZip($var, ':');
    }
}