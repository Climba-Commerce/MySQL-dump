<?php

namespace unit\src\Mask;

use MySQLDump\Mask\MaskValueDependsAnotherColumnValue;
use MySQLDump\Mask\MaskValueFixValue;
use PHPUnit\Framework\TestCase;

class MaskValueDependsAnotherColumnValueUnitTest extends TestCase
{
    public function testMaskValue()
    {
        $mask = new MaskValueDependsAnotherColumnValue();
        $mask->addMaskData('column', 'value', new MaskValueFixValue('fixValue'));

        $this->assertEquals('fixValue', $mask->maskValue('value', ['column' => 'value']));
        $this->assertEquals('value', $mask->maskValue('value', ['column' => 'otherValue']));
    }
}