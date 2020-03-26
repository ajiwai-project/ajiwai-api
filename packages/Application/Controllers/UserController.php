<?php

namespace Ajiwai\Application\Controllers;

use Ajiwai\Application\Requests\Auth\UserRequest;
use Ajiwai\Exceptions\BaseException;
use Ajiwai\Library\Auth\AuthUser;
use Ajiwai\Library\Auth\AuthUserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /** @var AuthUserRepositoryInterface */
    private $userRepository;

    /**
     * UserController constructor.
     * @param AuthUserRepositoryInterface $userRepository
     */
    public function __construct(AuthUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * ユーザー登録
     *
     * @param UserRequest $userRequest
     * @return JsonResponse
     */
    public function create(UserRequest $userRequest)
    {
        $result = $this->userRepository
            ->create($userRequest->toEntity());

        if (!$result) throw new BaseException('Conflict UserID', 409);

        return new JsonResponse([
            'status' => '201',
            'data' => [
                'userId' => $userRequest->get('user_id')
            ]
        ], 201);
    }

    public function self(AuthManager $authManager)
    {
        /** @var AuthUser $user */
        $user = $authManager->guard('api')->user();

        return new JsonResponse([
            'user_id' => $user->getAuthIdentifier(),
        ], Response::HTTP_OK);
    }
}
