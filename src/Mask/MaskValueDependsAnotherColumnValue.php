<?php

namespace MySQLDump\Mask;

class MaskValueDependsAnotherColumnValue implements IMaskValue
{
    private $maskList = [];

    public function maskValue($value = null, array $row = [])
    {
        foreach ($row as $rowColumn => $rowValue) {
            if (isset($this->maskList[$rowColumn], $this->maskList[$rowColumn][$rowValue])) {
                return $this->maskList[$rowColumn][$rowValue]->maskValue($value, $row);
            }
        }
        return $value;
    }

    public function addMaskData(string $dependsColumn, string $dependsValue, IMaskValue $mask): void
    {
        if (! isset($this->maskList[$dependsColumn])) {
            $this->maskList[$dependsColumn] = [];
        }
        $this->maskList[$dependsColumn][$dependsValue] = $mask;
    }
}