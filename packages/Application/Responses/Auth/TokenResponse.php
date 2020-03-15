<?php


namespace Ajiwai\Application\Responses\Auth;


use Illuminate\Http\JsonResponse;

class TokenResponse extends JsonResponse
{

    /**
     * TokenResponse constructor.
     * @param string $token
     * @param string $refreshToken
     */
    public function __construct(string $token, string $refreshToken)
    {
        parent::__construct([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expire_in'=>config('token.expire.accessToken') * 60,
            'refresh_token'=>$refreshToken
        ], parent::HTTP_OK);
    }
}
