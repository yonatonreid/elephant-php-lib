<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;


use ElephantTest\Env\AbstractTestCase;
use Elephant\Env\Arrays;

class ArrayPopTest extends AbstractTestCase
{
    public function testCanPopArray()
    {
        $stack = array("orange", "banana", "apple", "raspberry");
        $fruit = Arrays ::arrayPop($stack);
        $expected = ['orange', 'banana', 'apple'];
        $this -> assertEquals($expected, $stack);

        $this -> assertEquals('raspberry', $fruit);
    }
}