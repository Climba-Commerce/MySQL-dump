<?php

namespace MySQLDump\Mask;

class MaskValueRecrypt implements IMaskValue
{
    private $cryptoProvider;
    private $fieldConfig;

    public function __construct(
        ICryptoProvider $cryptoProvider,
        IFieldConfig $fieldConfig
    ) {
        $this->cryptoProvider = $cryptoProvider;
        $this->fieldConfig = $fieldConfig;
    }

    public function maskValue($value = null, array $row = [])
    {
        if ($this->fieldConfig->isEncryptableField($row) && $value) {
            try {
                $decrypted = $this->cryptoProvider->decrypt($value);
                $recrypted = $this->cryptoProvider->encrypt($decrypted);
                return $recrypted;
            } catch (\Throwable $e) {
                // Em caso de erro, retorna o valor original para não quebrar o dump
                return $value;
            }
        }
        return $value;
    }
}
