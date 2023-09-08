<?php

namespace unit\src\mask;

use Src\mask\MaskValueConcatStringPlusAutoIncrement;
use PHPUnit\Framework\TestCase;

class MaskValueConcatStringPlusAutoIncrementUnitTest extends TestCase
{
    public function testMaskValue()
    {
        $mask = new MaskValueConcatStringPlusAutoIncrement();

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals('test - ' . $index, $mask->maskValue('test'));
        }
    }
}