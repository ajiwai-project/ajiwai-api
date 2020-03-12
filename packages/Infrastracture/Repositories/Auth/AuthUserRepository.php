<?php


namespace Ajiwai\Infrastracture\Repositories\Auth;


use Ajiwai\Library\Auth\AuthUser;
use Ajiwai\Library\Auth\AuthUserRepositoryInterface;
use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;

class AuthUserRepository implements AuthUserRepositoryInterface
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

    /**
     * @param AuthUser $user
     * @return bool
     */
    public function create(AuthUser $user): bool
    {
        $users = $this->userFBDao
            ->findByUserID($user->id());

        if (!$users->isEmpty()) return false;

        $this->userFBDao
            ->register($user->id(), $user->hashPassword());

        return true;
    }
}
