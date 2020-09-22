<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;


use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;

class ArrayUnChunkTest extends TestCase
{
    public function testCanUnchunk()
    {
        $actual = array(
            array('Black Canyon City', 'Chandler', 'Flagstaff', 'Gilbert', 'Glendale', 'Globe'),
            array('Mesa', 'Miami', 'Phoenix', 'Peoria', 'Prescott', 'Scottsdale'),
            array('Sun City', 'Surprise', 'Tempe', 'Tucson', 'Wickenburg')
        );
        $expected = array("Black Canyon City", "Chandler", "Flagstaff", "Gilbert", "Glendale", "Globe", "Mesa", "Miami",
            "Phoenix", "Peoria", "Prescott", "Scottsdale", "Sun City", "Surprise", "Tempe", "Tucson", "Wickenburg");
        $this -> assertEquals($expected, Arrays ::arrayUnChunk($actual));
    }
}