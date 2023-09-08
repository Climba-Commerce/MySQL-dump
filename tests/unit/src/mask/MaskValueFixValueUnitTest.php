<?php

namespace unit\src\mask;

use MySQLDump\Mask\MaskValueFixValue;
use PHPUnit\Framework\TestCase;

class MaskValueFixValueUnitTest extends TestCase
{
    public function testMaskValueWithFixString()
    {
        $mask = new MaskValueFixValue('test');

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals('test', $mask->maskValue());
        }
    }

    public function testMaskValueWithFixInteger()
    {
        $mask = new MaskValueFixValue(1);

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(1, $mask->maskValue());
        }
    }

    public function testMaskValueWithFixFloat()
    {
        $mask = new MaskValueFixValue(10.55);

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(10.55, $mask->maskValue());
        }
    }

    public function testMaskValueWithFixBool()
    {
        $mask = new MaskValueFixValue(true);

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(true, $mask->maskValue());
        }

        $mask = new MaskValueFixValue(false);

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals(false, $mask->maskValue());
        }
    }
}