<?php

namespace  Ajiwai\Domain\Ajiwai;

class UserId
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}