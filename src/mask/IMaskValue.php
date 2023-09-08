<?php

namespace Src\mask;

interface IMaskValue
{
    public function maskValue($concatValue = null);
}