<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;


class ArrayKeyExistsTest extends AbstractTestCase
{
    public function testCanFindKey()
    {
        $search_array = array('first' => 1, 'second' => 4);
        $this -> assertTrue(Arrays ::arrayKeyExists('first', $search_array));
        $this -> assertTrue(Arrays ::arrayKeyExists('second', $search_array));
    }

    public function testStillReturnsKeyWithNullValue()
    {
        $search_array = array('first' => null, 'second' => null);
        $this -> assertTrue(Arrays ::arrayKeyExists('first', $search_array));
        $this -> assertTrue(Arrays ::arrayKeyExists('second', $search_array));
    }
}