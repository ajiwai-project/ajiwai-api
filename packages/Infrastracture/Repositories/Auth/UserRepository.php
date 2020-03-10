<?php


namespace Ajiwai\Infrastracture\Repositories\Auth;


use Ajiwai\Domain\Model\Auth\User;
use Ajiwai\Domain\Model\Auth\UserRepositoryInterface;
use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;

class UserRepository implements UserRepositoryInterface
{
    /** @var UserFBDao */
    private $userFBDao;

    /**
     * UserRepositoryImpl constructor.
     * @param $userFBDao
     */
    public function __construct(UserFBDao $userFBDao)
    {
        $this->userFBDao = $userFBDao;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        $users = $this->userFBDao
            ->findByUserID($user->id());

        if (!$users->isEmpty()) return false;

        $this->userFBDao
            ->register($user->id(), $user->hashPassword());

        return true;
    }
}
