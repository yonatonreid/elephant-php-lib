<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffUkeyTest extends AbstractTestCase
{
    public function testCanDiffUkey(){
        $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
        $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);
        $func = function($key1, $key2)
        {
            if ($key1 == $key2)
                return 0;
            else if ($key1 > $key2)
                return 1;
            else
                return -1;
        };
        $expected=['red'=>2,'purple'=>4];
        $this->assertEquals($expected,Arrays::arrayDiffUkey($array1,$array2,$func));
    }
}