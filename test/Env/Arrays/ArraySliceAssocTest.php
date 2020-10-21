<?php


namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArraySliceAssocTest extends AbstractTestCase
{
    public function testCanAssocSlice()
    {
        $arr = ['name' => 'Nathan', 'age' => 20, 'height' => 6];
        $expected = ['name' => 'Nathan', 'age' => 20];
        $this -> assertEquals($expected, Arrays ::arraySliceAssoc($arr, ['name', 'age']));

        $this -> assertEquals([], Arrays ::arraySliceAssoc($arr, []));
    }
}