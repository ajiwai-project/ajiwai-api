<?php

namespace Ajiwai\Application\Controllers\Auth;

use Ajiwai\Application\Requests\Auth\UserRequest;
use Ajiwai\Exceptions\BaseException;
use Ajiwai\Library\Auth\AuthUserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

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

        if (!$result) throw new BaseException('conflict userID', 409);

        return new JsonResponse([
            'status' => '201',
            'data' => [
                'userId' => $userRequest->input('userId')
            ]
        ], 201);
    }
}
