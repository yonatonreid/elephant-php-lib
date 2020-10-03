<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffKeyRecursiveTest extends AbstractTestCase
{
    public function testCanDiffRecursive()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4, 'salmon' => ['a' => 1, 'b' => 2, 'c' => 3]);
        $array2 = array('green' => 5, 'yellow' => 7, 'cyan' => 8, 'salmon' => ['a' => 1]);
        $expected = array("blue" => 1, "red" => 2, "purple" => 4, 'salmon' => ['b' => 2, 'c' => 3]);
        $this -> assertEquals($expected, Arrays ::arrayDiffKeyRecursive($array1, $array2));
    }

    public function testCanDiffRecursive2()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4, 'salmon' => ['a' => 1, 'b' => 2, 'c' => 3]);
        $array2 = array('green' => 5, 'yellow' => 7, 'cyan' => 8);
        $expected = array("blue" => 1, "red" => 2, "purple" => 4, 'salmon' => ['a' => 1, 'b' => 2, 'c' => 3]);
        $this -> assertEquals($expected, Arrays ::arrayDiffKeyRecursive($array1, $array2));
    }

}