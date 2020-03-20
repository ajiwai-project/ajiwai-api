<?php


namespace Ajiwai\Exceptions;


class NotFoundUserException extends BaseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('not found user, user id is incorrect');
        $this->setStatusCode(404);
        $this->setErrorCode('invalid_user_id');
        return parent::toResponse($request);
    }
}
