<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayWalkTest extends AbstractTestCase
{
    public function testCanWalk()
    {
        $fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
        $func = function (&$item1, $key, $prefix) {
            $item1 = "$prefix: $item1";
        };
        Arrays ::arrayWalk($fruits, $func, 'fruit');
        $expected = ['d' => 'fruit: lemon', 'a' => 'fruit: orange', 'b' => 'fruit: banana', 'c' => 'fruit: apple'];
        $this -> assertEquals($expected, $fruits);
    }
}