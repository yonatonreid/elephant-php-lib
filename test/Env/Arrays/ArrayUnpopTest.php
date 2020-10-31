<?php


namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayUnpopTest extends AbstractTestCase
{
    public function testCanUnpop()
    {
        $arr = array('orange', 'banana');
        $arr = Arrays ::arrayUnpop($arr, "apple", "raspberry");
        $this -> assertEquals(['orange', 'banana', 'apple', 'raspberry'], $arr);
    }

    public function testCanUnpopArray()
    {
        $arr = array('orange', 'banana');
        $arr = Arrays ::arrayUnpop($arr, ["apple"], ["raspberry"]);
        $this -> assertEquals(['orange', 'banana', ['apple'], ['raspberry']], $arr);
    }
}