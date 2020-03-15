<?php


namespace Ajiwai\Application\Controllers\Auth;


use Ajiwai\Application\Requests\Auth\UserRequest;
use Ajiwai\Application\Responses\Auth\TokenResponse;
use Ajiwai\Exceptions\BaseException;
use Ajiwai\Library\Auth\AjiwaiJWTGuard;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;

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


    public function login(UserRequest $request)
    {
        /** @var AjiwaiJWTGuard $guard */
        $guard = $this->authManager->guard('api');
        $token = $guard->attempt($request->toCredentials(), true);

        if (!$token) throw new BaseException('Not Found User', Response::HTTP_BAD_REQUEST);

        return new TokenResponse($token, $guard->createRefreshToken());
    }
}
