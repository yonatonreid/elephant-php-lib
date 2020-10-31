<?php
declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayCheckTest extends AbstractTestCase
{
    public function testCanReturnTruthWithNullValue()
    {
        $arr = ['a' => null, 'b' => null];
        $this -> assertTrue(Arrays ::arrayCheck('a', $arr));
    }

    public function testReturnsFalseOnNoKey()
    {
        $arr = ['a' => null, 'b' => null];
        $this -> assertFalse(Arrays ::arrayCheck('c', $arr));
    }
}