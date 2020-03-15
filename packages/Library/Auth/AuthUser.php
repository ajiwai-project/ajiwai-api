<?php


namespace Ajiwai\Library\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthUser implements JWTSubject, Authenticatable
{
    /** @var string */
    private $userId;
    /** @var string */
    private $password;

    /**
     * AuthUser constructor.
     * @param string $userId
     * @param string $password
     */
    public function __construct(string $userId, string $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }

    public function id(): string
    {
        return $this->userId;
    }

    /**
     * パスワードをハッシュ化する
     * @return string
     */
    public function hashPassword(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    public function getAuthIdentifier()
    {
        return $this->userId;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->userId;
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 利用しない
     * @inheritDoc
     */
    public function getRememberToken()
    {
        return;
    }

    /**
     * 利用しない
     * @inheritDoc
     */
    public function setRememberToken($value)
    {
        return;
    }

    /**
     * 利用しない
     * @inheritDoc
     */
    public function getRememberTokenName()
    {
        return;
    }
}
