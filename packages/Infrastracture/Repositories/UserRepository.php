<?php

namespace Ajiwai\Infrastracture\Repositories;

use Ajiwai\Domain\Ajiwai\Ajiwais;
use Ajiwai\Domain\Ajiwai\User;
use Ajiwai\Domain\Ajiwai\UserId;
use Ajiwai\Domain\User\UserRepositoryInterface;
use Ajiwai\Exceptions\NotFoundUserException;
use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;

class UserRepository implements UserRepositoryInterface
{
    /** @var UserFBDao */
    private $userFBDao;

    /**
     * AuthUserRepositoryImpl constructor.
     * @param $userFBDao
     */
    public function __construct(UserFBDao $userFBDao)
    {
        $this->userFBDao = $userFBDao;
    }

    //TODO
    public function findById(UserId $userId): User
    {
        $snapshot = current($this->userFBDao->findByUserID($userId)->rows());

        if ($snapshot == null) throw new NotFoundUserException();

        return new User(new UserId("test"), new Ajiwais(collect([])));
    }
}
