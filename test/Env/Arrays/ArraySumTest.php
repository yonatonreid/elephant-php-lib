<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArraySumTest extends AbstractTestCase
{
    public function testCanSum()
    {
        $a = array(2, 4, 6, 8);
        $exp = 20;
        $this -> assertEquals($exp, Arrays ::arraySum($a));
    }

    public function testCanSumFloat()
    {
        $a = array(1.2, 2.3, 3.4);
        $exp = 6.9;
        $this -> assertEquals($exp, Arrays ::arraySum($a));
    }

    public function testCanSumWithAssocKeys()
    {
        $a = array("a" => 1.2, "b" => 2.3, "c" => 3.4);
        $exp = 6.9;
        $this -> assertEquals($exp, Arrays ::arraySum($a));
    }
}