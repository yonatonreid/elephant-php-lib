<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayDiffAssocRecursiveTest extends AbstractTestCase
{
    public function testCanDiffRecursive()
    {
        $a1 = array('a' => 0, 'b' => null, 'c' => array('d' => null));
        $a2 = array('a' => 0, 'b' => null);
        $expected = ['c' => array('d' => null)];
        $this -> assertEquals($expected, Arrays ::arrayDiffAssocRecursive($a1, $a2));
    }

    public function testStrictStringEquals()
    {
        $array1 = array(0, 1, 2);
        $array2 = array("00", "01", "2");
        $expected = [0 => 0, 1 => 1];
        $this -> assertEquals($expected, Arrays ::arrayDiffAssocRecursive($array1, $array2));
    }

    public function testDuplicates()
    {
        $array1 = array(0 => "a", 1 => "b", 2 => "c", 3 => "a", 4 => "a");
        $array2 = array(0 => "a");
        $expected = array(1 => "b", 2 => "c", 3 => "a", 4 => "a");
        $this -> assertEquals($expected, Arrays ::arrayDiffAssocRecursive($array1, $array2));
    }
}