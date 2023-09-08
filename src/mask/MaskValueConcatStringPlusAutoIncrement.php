<?php

namespace Src\mask;

class MaskValueConcatStringPlusAutoIncrement implements IMaskValue
{
    /** @var int */
    protected $autoIncrementNumber = 0;

    /**
     * @param string $concatValue
     * @return string
     */
    public function maskValue($concatValue = null): string
    {
        $this->autoIncrementNumber++;
        return $concatValue . ' - ' . $this->autoIncrementNumber;
    }
}