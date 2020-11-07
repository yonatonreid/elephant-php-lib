<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;


class ArrayNukeKeys extends \ElephantTest\Env\AbstractTestCase
{
    public function testCanNukeKeys()
    {
        $arr = array('blue' => 1, 'red' => 2, 'green' => 3, 'purple' => 4);
        $keysToNuke = array('red', 'purple');
        $expected = array('blue' => 1, 'green' => 3);
        $this -> assertEquals($expected, Arrays ::arrayNukeKeys($keysToNuke, $arr));
    }
}