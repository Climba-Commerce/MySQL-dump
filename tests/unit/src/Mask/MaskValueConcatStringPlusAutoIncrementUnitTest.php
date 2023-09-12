<?php

namespace unit\src\Mask;

use MySQLDump\Mask\MaskValueConcatStringPlusAutoIncrement;
use PHPUnit\Framework\TestCase;

class MaskValueConcatStringPlusAutoIncrementUnitTest extends TestCase
{
    public function testMaskValue()
    {
        $mask = new MaskValueConcatStringPlusAutoIncrement('test');

        for ($index = 1; $index <= 10; $index++) {
            $this->assertEquals('test - ' . $index, $mask->maskValue());
        }
    }
}