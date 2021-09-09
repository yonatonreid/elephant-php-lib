<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;

class ArrayFlipTest extends \ElephantTest\Env\AbstractTestCase
{
    public function testCanFlip()
    {
        $input = array("oranges", "apples", "pears");
        $flipped = array("oranges" => 0, "apples" => 1, "pears" => 2);
        $this -> assertEquals($flipped, Arrays ::arrayFlip($input));
    }

    public function testHandleCollision()
    {
        $input = array("a" => 1, "b" => 1, "c" => 2);
        $flipped = array(1 => "b", 2 => "c");
        $this -> assertEquals($flipped, Arrays ::arrayFlip($input));
    }

    public function testPreservesOrder(){
        $input=[1=>1,2=>2,3=>3,4=>3,5=>2,6=>1,7=>1,8=>3,9=>3];
        $flipped=[2=>5,1=>7,3=>9];
        $this->assertEquals($flipped,Arrays::arrayFlip($input,true));
    }
}