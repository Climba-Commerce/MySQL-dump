<?php

namespace MySQLDump\Mask;

class MaskValueAutoIncrementNumber implements IMaskValue
{
    protected $autoIncrement = 0;

    public function maskValue($value = null, $row = null): int
    {
        $this->autoIncrement++;
        return $this->autoIncrement;
    }
}