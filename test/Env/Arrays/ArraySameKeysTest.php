<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArraySameKeysTest extends AbstractTestCase
{
    public function testHasSameKeys()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
        $array2 = array('blue' => 5, 'red' => 6, 'green' => 7, 'purple' => 8);
        $this -> assertTrue(Arrays ::arraySameKeys($array1, $array2));
    }

    public function testNotHasSameKeys()
    {
        $array1 = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
        $array2 = array('yellow' => 5, 'red' => 6, 'green' => 7, 'purple' => 8);
        $this -> assertFalse(Arrays ::arraySameKeys($array1, $array2));
    }
}