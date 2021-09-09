<?php


declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;

class ArrayValuesTest extends \ElephantTest\Env\AbstractTestCase
{
    public function testCanGetValues()
    {
        $array = array("size" => "XL", "color" => "gold");
        $exp = array("XL", "gold");
        $this -> assertEquals($exp, Arrays ::arrayValues($array));
    }

    public function testIgnoresNumericIndexes()
    {
        $a = array(3 => 11, 1 => 22, 2 => 33);
        $a[0] = 44;
        $exp = [0 => 11, 1 => 22, 2 => 33, 3 => 44];
        $this -> assertEquals($exp, Arrays ::arrayValues($a));
    }
}