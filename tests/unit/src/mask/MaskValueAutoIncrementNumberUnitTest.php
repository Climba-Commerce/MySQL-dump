<?php

namespace unit\src\mask;

use Src\mask\MaskValueAutoIncrementNumber;
use PHPUnit\Framework\TestCase;

class MaskValueAutoIncrementNumberUnitTest extends TestCase
{
    public function testMaskValue()
    {
        $mask = new MaskValueAutoIncrementNumber();

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals($index, $mask->maskValue());
        }
    }
}