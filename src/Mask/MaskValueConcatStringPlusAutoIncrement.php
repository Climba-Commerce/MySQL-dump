<?php

namespace MySQLDump\Mask;

class MaskValueConcatStringPlusAutoIncrement implements IMaskValue
{
    protected $autoIncrementNumber = 0;
    protected $stringConcat;

    public function __construct(string $value)
    {
        $this->stringConcat = $value;
    }

    public function maskValue($value = null, array $row = []): string
    {
        $this->autoIncrementNumber++;
        return $this->stringConcat . ' - ' . $this->autoIncrementNumber;
    }
}