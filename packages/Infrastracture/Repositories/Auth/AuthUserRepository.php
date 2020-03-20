<?php


namespace Ajiwai\Infrastracture\Repositories\Auth;


use Ajiwai\Exceptions\NotFoundUserException;
use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;
use Ajiwai\Library\Auth\AuthUser;
use Ajiwai\Library\Auth\AuthUserRepositoryInterface;

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

    public function create(AuthUser $user): bool
    {
        $users = $this->userFBDao
            ->findByUserID($user->id());

        if (!$users->isEmpty()) return false;

        $this->userFBDao
            ->register($user->id(), $user->hashPassword());

        return true;
    }

    public function findById(string $userId): AuthUser
    {
        $snapshot = current($this->userFBDao->findByUserID($userId)->rows());

        if ($snapshot == null) throw new NotFoundUserException();

        return new AuthUser($snapshot['user_id'], $snapshot['password']);
    }
}
