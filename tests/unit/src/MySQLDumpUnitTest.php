<?php

namespace unit\src;

use MySQLDump\Mask\MaskValueAutoIncrementNumber;
use MySQLDump\Mask\MaskValueConcatStringPlusAutoIncrement;
use MySQLDump\Mask\MaskValueDependsAnotherColumnValue;
use MySQLDump\Mask\MaskValueFixValue;
use Mockery;
use MySQLDump\MySQLDump;
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

        $mock->addMask('table', 'column', new MaskValueFixValue('fixValue'));
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

        $mock->addMask('table', 'column', new MaskValueConcatStringPlusAutoIncrement('fixValue'));
        $mask = $mock->maskData('table', 'column', 'value');

        $this->assertEquals('fixValue1', $mask);
    }

    public function testMaskDataWithDataToMaskWithTableDontExistsInMaskDataArray()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $mock->addMask('table', 'column', new MaskValueConcatStringPlusAutoIncrement('fixValue'));
        $mask = $mock->maskData('table1', 'column1', 'value');

        $this->assertEquals('value', $mask);
    }

    public function testMaskDataWithValueDependsAnotherColumnValue()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $maskDepends = new MaskValueDependsAnotherColumnValue(
            'nm_config',
            'usa_abc',
            new MaskValueFixValue('fixMaskValue')
        );

        $mock->addMask('configs', 'vl_config', $maskDepends);
        $row = [
            'nm_config' => 'usa_abc',
            'vl_config' => 'sim'
        ];
        $mask = $mock->maskData('configs', 'vl_config', 'nao', $row);

        $this->assertEquals('fixMaskValue', $mask);
    }

    public function testMaskDataWithValueDependsAnotherColumnValueFatherColumnValueNotMatch()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $maskDepends = new MaskValueDependsAnotherColumnValue(
            'nm_config',
            'usa_abc',
            new MaskValueFixValue('fixMaskValue')
        );

        $mock->addMask('configs', 'vl_config', $maskDepends);
        $row = [
            'nm_config' => 'usa_abcd',
            'vl_config' => 'sim'
        ];
        $mask = $mock->maskData('configs', 'vl_config', 'nao', $row);

        $this->assertEquals('nao', $mask);
    }

    public function testMaskDataWithValueDependsAnotherColumnValueFatherColumnNameNotMatch()
    {
        $mock = Mockery::mock(MySQLDump::class)->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        $maskDepends = new MaskValueDependsAnotherColumnValue(
            'nm_config',
            'usa_abc',
            new MaskValueFixValue('fixMaskValue')
        );

        $mock->addMask('configs', 'vl_config', $maskDepends);
        $row = [
            'nm_configs' => 'usa_abc',
            'vl_config' => 'sim'
        ];
        $mask = $mock->maskData('configs', 'vl_config', 'nao', $row);

        $this->assertEquals('nao', $mask);
    }
}