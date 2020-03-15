<?php


namespace Ajiwai\Library\Auth;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class FirebaseUserProvider implements UserProvider
{
    private $authUserRepository;

    /**
     * FirebaseUserProvider constructor.
     * @param $authUserRepository
     */
    public function __construct(AuthUserRepositoryInterface $authUserRepository)
    {
        $this->authUserRepository = $authUserRepository;
    }


    /**
     * @inheritDoc
     */
    public function retrieveById($identifier)
    {
        return $this->authUserRepository->findById($identifier);
    }

    /**
     * @inheritDoc
     */
    public function retrieveByToken($identifier, $token)
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function retrieveByCredentials(array $credentials)
    {
        return $this->authUserRepository->findById($credentials['user_id']);
    }

    /**
     * @inheritDoc
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return password_verify($credentials['password'], $user->getAuthPassword());
    }
}
