<?php

namespace Ajiwai\Domain\Ajiwai;


use function Ajiwai\Library\assert;

class AjiwaiId
{
    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        assert($value > 0, 'ajiwai id is not minus');
        $this->value = $value;
    }
}
