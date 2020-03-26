<?php


namespace Ajiwai\Exceptions;


class InvalidPasswordException extends BaseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('password is incorrect');
        $this->setStatusCode(400);
        $this->setErrorCode('invalid_password');
        return parent::toResponse($request);
    }
}
