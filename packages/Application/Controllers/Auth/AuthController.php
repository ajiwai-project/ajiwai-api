<?php


namespace Ajiwai\Application\Controllers\Auth;


use Ajiwai\Application\Requests\Auth\RefreshTokenRequest;
use Ajiwai\Application\Requests\Auth\UserRequest;
use Ajiwai\Application\Responses\Auth\TokenResponse;
use Ajiwai\Exceptions\InvalidPasswordException;
use Ajiwai\Library\Auth\AjiwaiJWTGuard;
use Ajiwai\Library\Auth\AjiwaiRefreshTokenGuard;
use Ajiwai\Library\Auth\AuthUser;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    private $authManager;

    /**
     * AuthController constructor.
     * @param $authManager
     */
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }


    public function login(UserRequest $request, AjiwaiRefreshTokenGuard $refreshTokenGuard)
    {
        /** @var AjiwaiJWTGuard $guard */
        $guard = $this->authManager->guard('api');
        $accessToken = $guard->attempt($request->toCredentials(), true);

        if (!$accessToken) throw new InvalidPasswordException();

        $refreshToken = $refreshTokenGuard->createRefreshToken($request->get('user_id'));

        return new TokenResponse($accessToken, $refreshToken);
    }

    /**
     * @param RefreshTokenRequest $request grant_typeとrefresh_tokenを必須とする
     * @param AjiwaiRefreshTokenGuard $refreshTokenGuard
     * @return JsonResponse
     */
    public function refresh(RefreshTokenRequest $request, AjiwaiRefreshTokenGuard $refreshTokenGuard)
    {
        /** @var AjiwaiJWTGuard $guard */
        $guard = $this->authManager->guard('api');

        //access_tokenからuser_idを取得する

        //リフレッシュトークンの検証する
        //invalidated => 400 bad request
        /** @var AuthUser $user */
        $user = $refreshTokenGuard->setRequest($request)
            ->validateRefreshToken();

        //access_tokenの発行
        $accessToken = $guard->setRequest($request)
            ->refresh();
        //refresh_tokenの発行
        $refreshToken = $refreshTokenGuard->refresh($user->id());

        return new TokenResponse($accessToken, $refreshToken);
    }
}
