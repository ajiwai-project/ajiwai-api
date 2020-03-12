<?php


namespace Ajiwai\Exceptions;


class RequestsValidateException extends BaseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('bad request');
        $this->setStatusCode(400);
        $this->setErrorCode('bad_request');
        return parent::toResponse($request);
    }
}
