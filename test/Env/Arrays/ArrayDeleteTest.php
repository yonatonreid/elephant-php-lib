<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDeleteTest extends AbstractTestCase
{
    public function testCanDeleteFromArray()
    {
        $array1 = array("a", "b", "c", "d");
        $delete = "a";
        $expected = array(1 => "b", 2 => "c", 3 => "d");
        $this -> assertEquals($expected, Arrays ::arrayDelete($delete, $array1));
    }

    public function testCanDeleteMultipleFromArray()
    {
        $array1 = array("a", "b", "c", "d", "a");
        $delete = "a";
        $expected = array(1 => "b", 2 => "c", 3 => "d");
        $this -> assertEquals($expected, Arrays ::arrayDelete($delete, $array1));
    }
}