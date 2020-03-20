<?php


namespace Ajiwai\Exceptions;


class NotFoundUserException extends BaseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('not found user');
        $this->setStatusCode(404);
        $this->setErrorCode('NOT_FOUND_USER');
        return parent::toResponse($request);
    }
}
