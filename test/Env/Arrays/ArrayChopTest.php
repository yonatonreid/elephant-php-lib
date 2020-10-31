<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayChopTest extends AbstractTestCase
{
    public function testCanChop()
    {
        $arr = ['bar', 'baz', 'bat'];
        $ret = Arrays ::arrayChop($arr, 2);
        $this -> assertEquals(['bar', 'baz'], $ret);
        $this -> assertEquals(['bat'], $arr);
        $this -> assertEquals(1, count($arr));
        $this -> assertEquals(2, count($ret));
    }
}