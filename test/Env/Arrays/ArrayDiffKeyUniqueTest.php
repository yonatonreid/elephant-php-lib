<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffKeyUniqueTest extends AbstractTestCase
{
    public function testCanDiffUniqueKeys()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
        $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan' => 8);
        $expected = array('red' => 2, 'purple' => 4, 'yellow' => 7, 'cyan' => 8);
        $this -> assertEquals($expected, Arrays ::arrayDiffKeyUnique($array1, $array2));
    }
}