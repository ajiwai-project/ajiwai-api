<?php

namespace  Ajiwai\Domain\Ajiwai;

class UserId
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
