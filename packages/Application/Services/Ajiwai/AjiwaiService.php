<?php

use Ajiwai\Domain\Ajiwai\Ajiwai;
use Ajiwai\Exceptions\NotFoundUserException;
use Ajiwai\Infrastracture\Repositories\Auth\AuthUserRepository;

class AjiwaiService
{
    /** @var AuthUserRepository */
    private $authUserRepository;

    public function __construct(AuthUserRepository $authUserRepository)
    {
        $this->authUserRepository = $authUserRepository;
    }

    public function save_ajiwai(string $userId, Ajiwai $ajiwai)
    {
        $user = $this->authUserRepository->findById($userId);

        if($user == null) throw new NotFoundUserException();

        // TODO
        return "";
    }
}
