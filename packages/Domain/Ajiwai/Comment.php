<?php

namespace Ajiwai\Domain\Ajiwai;

class Comment
{
    /** @var string */
    private $value;

    private function __constructor(string $value)
    {
        $this->vlaue = $value;
    }
}
