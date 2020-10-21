<?php


namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArraySliceAssocInverseTest extends AbstractTestCase
{
    public function testCanInverseAssocSlice()
    {
        $arr = ['name' => 'Nathan', 'age' => 20, 'height' => 6];
        $expected = ['age' => 20, 'height' => 6];
        $this -> assertEquals($expected, Arrays ::arraySliceAssocInverse($arr, ['name']));
    }
}