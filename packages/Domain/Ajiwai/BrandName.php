<?php

namespace Ajiwai\Domain\Ajiwai;


use function Ajiwai\Library\assert;

class BrandName
{


    private $value;

    public function __construct(string $value)
    {
        assert(strlen($value) < 40, 'brand name is less than 40 charactors');
        $this->value = $value;
    }
}
