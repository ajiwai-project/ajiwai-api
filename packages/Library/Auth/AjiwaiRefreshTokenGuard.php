<?php


namespace Ajiwai\Library\Auth;


use Ajiwai\Application\Requests\Auth\RefreshTokenRequest;
use Ajiwai\Exceptions\InvalidRefreshTokenException;
use Ajiwai\Infrastracture\Dao\Firebase\UserFBDao;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AjiwaiRefreshTokenGuard
{
    /** @var RefreshToken */
    private $refreshToken;
    /** @var AuthUserRepositoryInterface */
    private $authUserRepository;
    /** @var UserFBDao */
    private $userFBDao;
    /** @var RefreshTokenRequest */
    private $request;

    /**
     * AjiwaiRefreshTokenGuard constructor.
     * @param RefreshToken $refreshToken
     * @param AuthUserRepositoryInterface $authUserRepository
     * @param UserFBDao $userFBDao
     * @param RefreshTokenRequest $request
     */
    public function __construct(RefreshToken $refreshToken, AuthUserRepositoryInterface $authUserRepository, UserFBDao $userFBDao, RefreshTokenRequest $request)
    {
        $this->refreshToken = $refreshToken;
        $this->authUserRepository = $authUserRepository;
        $this->userFBDao = $userFBDao;
        $this->request = $request;
    }

    /**
     * リフレッシュトークンを生成する
     * @param string $userId
     * @return string
     */
    public function createRefreshToken(string $userId): string
    {
        $token = $this->refreshToken->initialize();
        $this->updateRefreshTokenId($userId);
        return $token;
    }

    /**
     * リフレッシュトークンをユーザーに保存する
     * @param string $userId
     */
    private function updateRefreshTokenId(string $userId): void
    {
        $this->authUserRepository
            ->updateRefreshId(
                new AuthUser($userId, null, $this->refreshToken->id())
            );
    }

    /**
     * リフレッシュトークンの検証をする
     * @return AuthUser
     * @throws TokenBlacklistedException
     */
    public function validateRefreshToken(): AuthUser
    {
        $this->refreshToken
            ->setToken($this->request->token())
            ->decode();

        $result = current($this->userFBDao
            ->findByRefreshId($this->refreshToken->id())
            ->rows());

        if ($result == null) throw new InvalidRefreshTokenException();

        return $this->authUserRepository->findById($result['user_id']);
    }

    public function setRequest(RefreshTokenRequest $request): AjiwaiRefreshTokenGuard
    {
        $this->request = $request;

        return $this;
    }
}
