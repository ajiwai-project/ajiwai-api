<?php

use Ajiwai\Domain\Ajiwai\Ajiwai;
use Ajiwai\Domain\Ajiwai\User;
use Ajiwai\Domain\User\UserRepositoryInterface;

class AjiwaiService
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->userRepository = $UserRepository;
    }

    public function save_ajiwai(string $userId, Ajiwai $ajiwai)
    {
        /** @var User */
        $user = $this->userRepository->findById($userId);

        $user->createAjiwai($ajiwai);

        //TODO update user data

        //TODO call engine service

        // TODO
        return "";
    }
}
