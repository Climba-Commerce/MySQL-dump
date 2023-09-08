<?php

namespace Src\mask;

class MaskValueAutoIncrementNumber implements IMaskValue
{
    /** @var $autoIncrement */
    protected $autoIncrement = 0;

    /**
     * @param null $concatValue
     * @return int
     */
    public function maskValue($concatValue = null): int
    {
        $this->autoIncrement++;
        return $this->autoIncrement;
    }
}