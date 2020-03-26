<?php


namespace Ajiwai\Exceptions;


class NotFoundRefreshIdException extends BaseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('incorrect refresh id');
        $this->setStatusCode(401);
        $this->setErrorCode('invalid_refresh_id');
        return parent::toResponse($request);
    }
}
