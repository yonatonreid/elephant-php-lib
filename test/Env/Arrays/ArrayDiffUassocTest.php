<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffUassocTest extends AbstractTestCase
{
    public function testCanDiffUassoc(){
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "yellow", "red");
        $expected = array("b"=>"brown","c"=>"blue",0=>"red");
        $func = function($a, $b)
        {
            if ($a === $b) {
                return 0;
            }
            return ($a > $b)? 1:-1;
        };
        $this->assertEquals($expected,Arrays::arrayDiffUassoc($array1,$array2,$func));
    }
}