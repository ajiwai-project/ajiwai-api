<?php

namespace  Ajiwai\Domain\Ajiwai;

use Illuminate\Support\Collection;

class Ajiwais
{
    /** @var Collection */
    private $value;

    public function __construct(Collection $value)
    {
        $this->value = $value;
    }

    public function addAjiwai(Ajiwai $ajiwai)
    {
        if ($ajiwai->hasId) {
            $this->value = $this->value->concat([$ajiwai]);
            return true;
        }

        return false;
    }

    public function createAjiwaiId()
    {
        return new AjiwaiId($this->value->count() + 1);
    }
}
