<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayPartitionTest extends AbstractTestCase
{
    public function testCanPartitionArray()
    {
        $actual = array("Black Canyon City", "Chandler", "Flagstaff", "Gilbert", "Glendale", "Globe", "Mesa", "Miami",
            "Phoenix", "Peoria", "Prescott", "Scottsdale", "Sun City", "Surprise", "Tempe", "Tucson", "Wickenburg");
        $expected = [
            0 => ['Black Canyon City', 'Chandler', 'Flagstaff', 'Gilbert', 'Glendale', 'Globe'],
            1 => ['Mesa', 'Miami', 'Phoenix', 'Peoria', 'Prescott', 'Scottsdale'],
            2 => ['Sun City', 'Surprise', 'Tempe', 'Tucson', 'Wickenburg']
        ];
        $this -> assertEquals($expected, Arrays ::arrayPartition($actual, 3));
    }
}