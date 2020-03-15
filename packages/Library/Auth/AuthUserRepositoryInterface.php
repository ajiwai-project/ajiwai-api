<?php


namespace Ajiwai\Library\Auth;


interface AuthUserRepositoryInterface
{
    /**
     * @param AuthUser $authUser
     * @return bool
     */
    public function create(AuthUser $authUser): bool;

    /**
     * @param string $userId
     * @return AuthUser 認証用ユーザークラス
     */
    public function findById(string $userId): AuthUser;
}
