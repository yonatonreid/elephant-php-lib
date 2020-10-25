<?php


namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayReorderTest extends AbstractTestCase
{
    public function testCanReorder()
    {
        $a = array(
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e'
        );
        $order = array('c', 'b', 'a');
        $expected = ['c' => 'c', 'b' => 'b', 'a' => 'a', 'd' => 'd', 'e' => 'e'];
        $this -> assertEquals($expected, Arrays ::arrayReorder($a, $order));
    }

    public function testCanReorderNoKeepRemaining()
    {
        $a = array(
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e'
        );
        $order = array('c', 'b', 'a');
        $expected = ['c' => 'c', 'b' => 'b', 'a' => 'a'];
        $this -> assertEquals($expected, Arrays ::arrayReorder($a, $order, false));
    }

    public function testCanReorderPrepend()
    {
        $a = array(
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e'
        );
        $order = array('c', 'b', 'a');
        $expected = ['d' => 'd', 'e' => 'e','c' => 'c', 'b' => 'b', 'a' => 'a'];
        $this->assertEquals($expected,Arrays ::arrayReorder($a, $order,true,true));
    }
}