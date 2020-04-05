<?php

namespace Ajiwai\Domain\User;

use Ajiwai\Domain\Ajiwai\User;
use Ajiwai\Domain\Ajiwai\UserId;

interface UserRepositoryInterface
{
    public function findById(UserId $userId): User;
}
