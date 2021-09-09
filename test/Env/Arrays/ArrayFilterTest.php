<?php

declare(strict_types=1);


namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayFilterTest extends AbstractTestCase
{
    public function testCanFilter()
    {
        $even = function ($var) {
            return !($var & 1);
        };
        $odd = function ($var) {
            return ($var & 1);
        };

        $array1 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        $array2 = [6, 7, 8, 9, 10, 11, 12];

        $expEven = [0 => 6, 2 => 8, 4 => 10, 6 => 12];
        $expOdd = ['a' => 1, 'c' => 3, 'e' => 5];

        $this -> assertEquals($expEven, Arrays ::arrayFilter($array2, $even, 0));
        $this -> assertEquals($expOdd, Arrays ::arrayFilter($array1, $odd, 0));
    }
}