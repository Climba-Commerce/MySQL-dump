<?php

namespace Src\mask;

class MaskValueFixValue implements IMaskValue
{
    /**
     * @param string|int|float|null $concatValue
     * @return string|int|float|null
     */
    public function maskValue($concatValue = null)
    {
        return $concatValue;
    }
}