<?php

namespace App\Exceptions;

use Ajiwai\Exceptions\BaseException;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        // Responsableインターフェースを継承したクラスはここでレスポンスを返す
        if ($exception instanceof Responsable) {
            return $exception->toResponse($request);
        }

        // HTTP系例外が発生した場合
        if ($this->isHttpException($exception)) {
            return $this->toResponse($request, $exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof TokenInvalidException) {
            return $this->toResponse($request, 'token is invalid', 400);
        }

        // それ以外の場合は Internal Server Error とする
        return $this->toResponse($request, 'Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function toResponse($request, string $message, int $statusCode)
    {
        return (new BaseException($message, $statusCode))
            ->toResponse($request);
    }
}
