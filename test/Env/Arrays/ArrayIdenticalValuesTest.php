<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayIdenticalValuesTest extends AbstractTestCase
{
    public function testIsIdentical()
    {
        $a = array("a", "b", "c");
        $b = array("a", "b", "c");
        $expected = true;
        $this -> assertEquals($expected, Arrays ::arrayIdenticalValues($a, $b));
    }

    public function testIsNotIdentical()
    {
        $array1 = array("red", "green", "blue");
        $array2 = array("red", "green", "blue", "yellow");
        $expected = false;
        $this -> assertEquals($expected, Arrays ::arrayIdenticalValues($array1, $array2));
    }

    public function testKeysNotSameStillIdentical()
    {
        $a = array("red", "green", "blue");
        $b = array("x" => "red", "y" => "green", "z" => "blue");
        $expected = true;
        $this -> assertEquals($expected, Arrays ::arrayIdenticalValues($a, $b));
    }
}