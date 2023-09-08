<?php

namespace unit\src;

use Src\mask\MaskValueAutoIncrementNumber;
use Src\mask\MaskValueConcatStringPlusAutoIncrement;
use Src\mask\MaskValueFixValue;
use Mockery;
use Src\MySQLDump;
use PHPUnit\Framework\TestCase;

class MySQLDumpUnitTest extends TestCase
{
    public function testRemoveCrasisFromString()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $this->assertEquals('table', $mock->removeCrasisFromString('table'));
        $this->assertEquals('table_test', $mock->removeCrasisFromString('`table_test`'));
    }

    public function testMaskDataWithoutDataToMask()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $this->assertEquals('value', $mock->maskData('table', 'column', 'value'));
    }

    public function testMaskDataWithDataToMaskWithMaskValueFixValue()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $mock->addMask('table', 'column', new MaskValueFixValue(), 'fixValue');
        $mask = $mock->maskData('table', 'column', 'value');

        $this->assertEquals('fixValue', $mask);
    }

    public function testMaskDataWithDataToMaskWithMaskValueAutoIncrementNumber()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $mock->addMask('table', 'column', new MaskValueAutoIncrementNumber());
        $mask = $mock->maskData('table', 'column', 'value');

        $this->assertEquals(1, $mask);
    }

    public function testMaskDataWithDataToMaskWithMaskValueConcatStringPlusAutoIncrement()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $mock->addMask('table', 'column', new MaskValueConcatStringPlusAutoIncrement(), 'fixValue');
        $mask = $mock->maskData('table', 'column', 'value');

        $this->assertEquals('fixValue - 1', $mask);
    }

    public function testMaskDataWithDataToMaskWithTableDontExistsInMaskDataArray()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $mock->addMask('table', 'column', new MaskValueConcatStringPlusAutoIncrement(), 'fixValue');
        $mask = $mock->maskData('table1', 'column1', 'value');

        $this->assertEquals('value', $mask);
    }
}