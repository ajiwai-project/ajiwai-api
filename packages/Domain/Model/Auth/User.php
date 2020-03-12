<?php


namespace Ajiwai\Domain\Model\Auth;

class User
{
    /** @var string */
    private $userId;
    /** @var string */
    private $password;

    /**
     * User constructor.
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
}
