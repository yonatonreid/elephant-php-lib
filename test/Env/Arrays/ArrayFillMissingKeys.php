<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;

class ArrayFillMissingKeys extends \ElephantTest\Env\AbstractTestCase
{
    public function testCanFillMissingKeys()
    {
        $arr = [0 => 1, 1 => 1];
        $exp = [0 => 1, 1 => 1, 2 => null, 3 => null, 4 => null];
        $this -> assertEquals($exp, Arrays ::arrayFillMissingKeys(0, $arr, null, 5));
    }

    public function testCanFillMissingKeysWithValue()
    {
        $arr = [0 => 1, 1 => 1];
        $exp = [0 => 1, 1 => 1, 2 => 'banana', 3 => 'banana', 4 => 'banana'];
        $this -> assertEquals($exp, Arrays ::arrayFillMissingKeys(0, $arr, 'banana', 5));
    }

    public function testCanFillWithSpecificIndex()
    {
        $arr = [0 => 1, 1 => 1];
        $exp = [0 => 1, 1 => 1, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null];
        $this -> assertEquals($exp, Arrays ::arrayFillMissingKeys(3, $arr, null, 5));
    }
}