<?php

namespace MySQLDump\Mask;

class MaskValueConcatStringPlusAutoIncrement implements IMaskValue
{
    protected $autoIncrementNumber = 0;
    protected $beforeStringConcat;
    protected $afterStringConcat;

    public function __construct(string $beforeStringConcat, string $afterStringConcat = '')
    {
        $this->beforeStringConcat = $beforeStringConcat;
        $this->afterStringConcat = $afterStringConcat;
    }

    public function maskValue($value = null, array $row = []): string
    {
        $this->autoIncrementNumber++;
        return $this->beforeStringConcat . $this->autoIncrementNumber . $this->afterStringConcat;
    }
}