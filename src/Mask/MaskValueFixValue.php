<?php

namespace MySQLDump\Mask;

class MaskValueFixValue implements IMaskValue
{
    protected $value;

    /**
     * @param string|int|float|null $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string|int|float|null
     */
    public function maskValue($value = null, $row = null)
    {
        return $this->value;
    }
}