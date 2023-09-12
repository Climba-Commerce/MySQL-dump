<?php

namespace MySQLDump\Mask;

class MaskValueDependsAnotherColumnValue implements IMaskValue
{
    private $dependsColumn;
    private $dependsValue;
    private $mask;

    public function __construct(string $dependsColumn, string $dependsValue, IMaskValue $mask)
    {
        $this->dependsColumn = $dependsColumn;
        $this->dependsValue = $dependsValue;
        $this->mask = $mask;
    }

    public function maskValue($value = null, array $row = [])
    {
        if (isset($row[$this->dependsColumn]) && $row[$this->dependsColumn] == $this->dependsValue) {
            return $this->mask->maskValue($value, $row);
        }
        return $value;
    }
}