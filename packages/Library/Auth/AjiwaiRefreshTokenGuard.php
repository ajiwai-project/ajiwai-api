<?php


namespace Ajiwai\Library\Auth;


use Ajiwai\Application\Requests\Auth\RefreshTokenRequest;
use Illuminate\Http\Request;

class AjiwaiRefreshTokenGuard
{
    /** @var RefreshToken */
    private $refreshToken;
    /** @var AuthUserRepositoryInterface */
    private $authUserRepository;
    /** @var RefreshTokenRequest */
    private $request;

    /**
     * AjiwaiRefreshTokenGuard constructor.
     * @param RefreshToken $refreshToken
     * @param AuthUserRepositoryInterface $authUserRepository
     * @param RefreshTokenRequest $request
     */
    public function __construct(RefreshToken $refreshToken, AuthUserRepositoryInterface $authUserRepository, RefreshTokenRequest $request)
    {
        $this->refreshToken = $refreshToken;
        $this->authUserRepository = $authUserRepository;
        $this->request = $request;
    }


    public function createRefreshToken(string $userId): string
    {
        $token = $this->refreshToken->initialize();
        $this->updateRefreshTokenId($userId);
        return $token;
    }

    private function updateRefreshTokenId(string $userId)
    {
        $this->authUserRepository
            ->updateRefreshId(
                new AuthUser($userId, null , $this->refreshToken->id())
            );
    }

    public function validateRefreshToken()
    {
         $this->refreshToken
             ->setToken($this->request->token())
            ->validate();

        return $this->authUserRepository
            ->findByRefreshId($this->refreshToken->id());
    }

    public function setRequest(RefreshTokenRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    public function refresh(string $userId)
    {
        $this->refreshToken = $this->refreshToken->invalidate();
        return self::createRefreshToken($userId);
    }
}
