<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayPickTest extends AbstractTestCase
{
    public function testCanPickArrays()
    {
        $res = ['foo' => 1, 'baz' => 2, 'bar' => 3, 'bat' => 4];
        $keys = ['foo', 'bat'];
        $this -> assertEquals(['foo' => 1, 'bat' => 4], Arrays ::arrayPick($res, $keys));
    }

    public function testCanPickScalar()
    {
        $res = ['foo' => 1, 'baz' => 2, 'bar' => 3, 'bat' => 4];
        $keys = 'foo';
        $this -> assertEquals(['foo' => 1], Arrays ::arrayPick($res, $keys));
    }
}