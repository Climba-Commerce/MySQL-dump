<?php

namespace Src\mask;

class MaskValueAutoIncrementNumber implements IMaskValue
{
    /** @var $autoIncrement */
    protected $autoIncrement = 0;

    /**
     * @return int
     */
    public function maskValue(): int
    {
        $this->autoIncrement++;
        return $this->autoIncrement;
    }
}