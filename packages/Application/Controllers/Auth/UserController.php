<?php

namespace Ajiwai\Application\Controllers\Auth;

use Ajiwai\Application\Requests\Auth\UserRequest;
use Ajiwai\Domain\Model\Auth\UserRepositoryInterface;
use Ajiwai\Infrastracture\Repositories\Auth\UserRepositoryImpl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
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

        if (!$result) throw new HttpResponseException(response()->json([
            'status' => 409,
            'message' => 'conflict userId'
        ], 409));

        return new JsonResponse([
            'status' => '201',
            'data' => [
                'userId' => $userRequest->input('userId')
            ]
        ], 201);
    }
}
