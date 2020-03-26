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
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

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

    /**
     * ログイン
     * @param UserRequest $request
     * @param AjiwaiRefreshTokenGuard $refreshTokenGuard
     * @return TokenResponse
     */
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
     * アクセストークンをリフレッシュする
     * @param RefreshTokenRequest $request
     * @param AjiwaiRefreshTokenGuard $refreshTokenGuard
     * @return JsonResponse
     * @throws TokenBlacklistedException
     */
    public function refresh(RefreshTokenRequest $request, AjiwaiRefreshTokenGuard $refreshTokenGuard)
    {

        /** @var AuthUser $user */
        $user = $refreshTokenGuard->setRequest($request)
            ->validateRefreshToken();

        /** @var AjiwaiJWTGuard $guard */
        $guard = $this->authManager->guard('api');
        $accessToken = $guard->refreshAccessToken($user, $request);
        $refreshToken = $refreshTokenGuard->createRefreshToken($user->id());

        return new TokenResponse($accessToken, $refreshToken);
    }
}
