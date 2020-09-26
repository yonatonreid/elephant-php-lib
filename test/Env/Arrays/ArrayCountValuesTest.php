<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;
use ErrorException;

class ArrayCountValuesTest extends AbstractTestCase
{
    public function testElementIsNotStringOrInteger()
    {
        $this -> expectException(ErrorException::class);
        Arrays ::arrayCountValues(array([1, 2, 3, 5]));
    }

    public function testCanCountValues()
    {
        $array = array(1, "hello", 1, "world", "hello");
        $expected = [1 => 2, 'hello' => 2, 'world' => 1];
        $this -> assertEquals($expected, Arrays ::arrayCountValues($array));
    }

    public function testCanGetGroupedCount()
    {
        $list = [
            ['id' => 1, 'userId' => 5],
            ['id' => 2, 'userId' => 5],
            ['id' => 3, 'userId' => 6],
        ];
        $expected = 2;
        $this -> assertEquals($expected, Arrays ::arrayCountValues($list, 'userId', 5));
    }
}