<?php

namespace Ajiwai\Domain\Ajiwai;

class User
{

    /** @var UserId */
    private $userId;
    /** @var Ajiwais */
    private $ajiwais;

    public function __construct(UserId $userId, Ajiwais $ajiwais)
    {
        $this->userId = $userId;
        $this->ajiwais = $ajiwais;
    }
}
