<?php
declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use ElephantTest\Env\AbstractTestCase;

class ArrayZipTest extends AbstractTestCase
{
    public function testCanZip(){
        $arr = ['a'=>'apple','b'=>'banana','c'=>'corn','d'=>'devilseggs'];
        Arrays::arrayZip($arr,":");
        $expected = ['a'=>'a:apple','b'=>'b:banana','c'=>'c:corn','d'=>'d:devilseggs'];
        $this->assertEquals($expected,$arr);
    }
}