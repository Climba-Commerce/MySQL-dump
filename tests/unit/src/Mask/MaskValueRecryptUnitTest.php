<?php

namespace unit\src\Mask;

use MySQLDump\Mask\ICryptoProvider;
use MySQLDump\Mask\IFieldConfig;
use MySQLDump\Mask\MaskValueRecrypt;
use PHPUnit\Framework\TestCase;

class MaskValueRecryptUnitTest extends TestCase
{
    public function testRecryptProtectedConfigWithInterfaces()
    {
        $cryptoProvider = \Mockery::mock(ICryptoProvider::class);
        $fieldConfig = \Mockery::mock(IFieldConfig::class);

        $fieldConfig->shouldReceive('isEncryptableField')
            ->with(['tp_campo' => 'protected', 'vl_config' => 'encrypted_value'])
            ->andReturn(true);

        $cryptoProvider->shouldReceive('decrypt')->andReturn('decrypted_value');
        $cryptoProvider->shouldReceive('encrypt')->andReturn('reencrypted_value');

        $mask = new MaskValueRecrypt(
            $cryptoProvider,
            $fieldConfig
        );

        $result = $mask->maskValue('encrypted_value', [
            'tp_campo' => 'protected',
            'vl_config' => 'encrypted_value'
        ]);

        $this->assertEquals('reencrypted_value', $result);
    }

    public function testNonProtectedFieldReturnsOriginalValue()
    {
        $cryptoProvider = \Mockery::mock(ICryptoProvider::class);
        $fieldConfig = \Mockery::mock(IFieldConfig::class);

        $fieldConfig->shouldReceive('isEncryptableField')
            ->with(['tp_campo' => 'public', 'vl_config' => 'normal_value'])
            ->andReturn(false);

        $mask = new MaskValueRecrypt(
            $cryptoProvider,
            $fieldConfig
        );

        $result = $mask->maskValue('normal_value', [
            'tp_campo' => 'public',
            'vl_config' => 'normal_value'
        ]);

        $this->assertEquals('normal_value', $result);
    }
}