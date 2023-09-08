<?php

namespace MySQLDump\Src\mask;

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
    public function maskValue()
    {
        return $this->value;
    }
}