<?php

namespace unit\src\mask;

use MaskValueFixValue;
use PHPUnit\Framework\TestCase;

class MaskValueFixValueUnitTest extends TestCase
{
    public function testMaskValueWithFixString()
    {
        $mask = new MaskValueFixValue();

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals('test', $mask->maskValue('test'));
        }
    }

    public function testMaskValueWithFixInteger()
    {
        $mask = new MaskValueFixValue();

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(1, $mask->maskValue(1));
        }
    }

    public function testMaskValueWithFixFloat()
    {
        $mask = new MaskValueFixValue();

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(10.55, $mask->maskValue(10.55));
        }
    }

    public function testMaskValueWithFixBool()
    {
        $mask = new MaskValueFixValue();

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(true, $mask->maskValue(true));
            $this->assertEquals(false, $mask->maskValue(false));
        }
    }

    public function testMaskValueWithRandomInt()
    {
        $mask = new MaskValueFixValue();

        for ($index = 1; $index <= 10; $index++) {
            $randomInt = rand(1, 100);
            $this->assertEquals($randomInt, $mask->maskValue($randomInt));
        }
    }
}