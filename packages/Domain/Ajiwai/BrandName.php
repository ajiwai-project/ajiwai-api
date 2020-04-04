<?php

namespace Ajiwai\Domain\Ajiwai;

use Ajiwai\Exceptions\BaseException;

class BrandName
{
    
    
    private $value;

    public function __construct(string $value)
    {
        if (strlen($value) >= 40){
            throw new BaseException('brand name is less than 40 charactors');
        }
        $this->value = $value;
    }
}