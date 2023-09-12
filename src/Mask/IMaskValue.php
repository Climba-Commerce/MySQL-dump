<?php

namespace MySQLDump\Mask;

interface IMaskValue
{
    public function maskValue($value = null, $row = null);
}