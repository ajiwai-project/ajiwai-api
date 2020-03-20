<?php


namespace Ajiwai\Library\Auth;


use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTGuard;

class AjiwaiJWTGuard extends JWTGuard
{
    /**
     * Instantiate the class.
     *
     * @param JWT $jwt
     * @param UserProvider $provider
     * @param Request $request
     *
     */
    public function __construct(JWT $jwt, UserProvider $provider, Request $request)
    {
        parent::__construct($jwt, $provider, $request);
    }

    public function login(JWTSubject $user)
    {
        $token = $this->setTTL(config('token.expire.accessToken'))
            ->jwt
            ->fromUser($user);

        $this->setToken($token)
            ->setUser($user);

        return $token;
    }
}
