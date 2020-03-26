<?php


namespace Ajiwai\Exceptions;


class InvalidRefreshTokenException extends BaseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('invalid refresh token');
        $this->setStatusCode(401);
        $this->setErrorCode('unauthorized');
        return parent::toResponse($request);
    }
}
