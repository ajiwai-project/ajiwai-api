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
     * 指定したIDのユーザーを取得する
     * @param string $userId
     * @return AuthUser 認証用ユーザークラス
     */
    public function findById(string $userId): AuthUser;

    /**
     * リフレッシュトークンIDを更新する
     * @param AuthUser $user
     */
    public function updateRefreshId(AuthUser $user): void;
}
