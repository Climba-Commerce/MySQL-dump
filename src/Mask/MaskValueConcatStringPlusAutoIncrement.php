<?php

namespace MySQLDump\Mask;

class MaskValueConcatStringPlusAutoIncrement implements IMaskValue
{
    protected $autoIncrementNumber = 0;
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function maskValue(): string
    {
        $this->autoIncrementNumber++;
        return $this->value . ' - ' . $this->autoIncrementNumber;
    }
}