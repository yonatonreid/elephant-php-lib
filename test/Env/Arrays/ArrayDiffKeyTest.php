<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffKeyTest extends AbstractTestCase
{
    public function testCanDiffKey()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
        $array2 = array('green' => 5, 'yellow' => 7, 'cyan' => 8);
        $expected = array("blue" => 1, "red" => 2, "purple" => 4);
        $this -> assertEquals($expected, Arrays ::arrayDiffKey($array1, $array2));
    }

    public function testCanDiffMultipleArrays()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
        $array2 = array('green' => 5, 'yellow' => 7, 'cyan' => 8);
        $array3 = array('blue' => 6, 'yellow' => 7, 'mauve' => 8);
        $expected = array("red" => 2, "purple" => 4);
        $this -> assertEquals($expected, Arrays ::arrayDiffKey($array1, $array2, $array3));
    }
}