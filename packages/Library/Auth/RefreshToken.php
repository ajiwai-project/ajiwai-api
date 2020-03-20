<?php

namespace Ajiwai\Library\Auth;

use Ajiwai\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\JWT;

class RefreshToken
{
    /** @var string */
    private $id;
    /** @var JWT  */
    private $jwt;

    /**
     * RefreshTokenFactory constructor.
     * @param $jwt
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }


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

    private function initializeId()
    {
        $this->id = uniqid(rand().'_');
    }

    public function id(): string
    {
        return $this->id;
    }

    public function validate(): bool
    {
        Log::info($this->jwt
            ->getPayload()
            ->get('jti'));

        $this->id = $this->jwt
            ->getPayload()
            ->get('sub');

        if ($this->id == null) throw new BaseException('bad request', 400);

        return true;
    }

    public function setToken(string $token)
    {
        $this->jwt
            ->setToken($token);

        return $this;
    }

    public function invalidate()
    {
        $this->jwt->invalidate();
        return new RefreshToken($this->jwt);
    }
}
