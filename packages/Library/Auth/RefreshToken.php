<?php

namespace Ajiwai\Library\Auth;

use Ajiwai\Exceptions\InvalidRefreshTokenException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\Token;

class RefreshToken
{
    /** @var Token */
    private $value;
    /** @var string */
    private $id;
    /** @var JWT */
    private $jwt;

    /**
     * RefreshTokenFactory constructor.
     * @param $jwt
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * リフレッシュトークンを初期化する
     * @return string リフレッシュトークン
     */
    public function initialize(): string
    {
        $this->initializeId();
        $payload = $this->jwt->factory()
            ->setTTL(config('token.expire.refreshToken'))
            ->customClaims([
                'sub' => $this->id,
            ])
            ->make();
        return $this->jwt->manager()->encode($payload)->get();
    }

    private function initializeId(): void
    {
        $this->id = uniqid(rand() . '_');
    }

    public function id(): string
    {
        return $this->id;
    }

    /**
     * リフレッシュトークンをデコードする
     * @return RefreshToken
     * @throws TokenBlacklistedException
     */
    public function decode(): RefreshToken
    {
        $this->id = $this->jwt
            ->manager()
            ->decode($this->value, false)
            ->get('sub');

        if ($this->id == null) throw new InvalidRefreshTokenException();

        return $this;
    }

    public function setToken(string $token): RefreshToken
    {
        $this->value = $token instanceof Token ? $token : new Token($token);

        return $this;
    }
}
