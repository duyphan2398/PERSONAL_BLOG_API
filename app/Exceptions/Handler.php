<?php

namespace App\Exceptions;

use App\Traits\HandleErrorException;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use HandleErrorException;

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
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($this->isHttpException($exception))
        {
            switch ($exception->getStatusCode())
            {
                case 404:
                    return redirect()->route('web.home');
                    break;
            }
        }

        if ($request->wantsJson()) {
            $this->convertDefaultException($exception);

            if ($exception instanceof UnauthorizedHttpException) {
                $case = $exception->getPrevious() ? get_class($exception->getPrevious()) : null;
                switch ($case) {
                    case \Tymon\JWTAuth\Exceptions\TokenExpiredException::class:
                        return response()->json([
                            'code'    => $exception->getStatusCode(),
                            'message' => trans('auth.expired'),
                        ], $exception->getStatusCode());
                    case \Tymon\JWTAuth\Exceptions\TokenInvalidException::class:
                    case \Tymon\JWTAuth\Exceptions\TokenBlacklistedException::class:
                        return response()->json([
                            'code'    => $exception->getStatusCode(),
                            'message' => trans('auth.invalid'),
                        ], $exception->getStatusCode());
                    default:
                        return response()->json([
                            'code'    => $exception->getStatusCode(),
                            'message' => trans('auth.not_found'),
                        ], $exception->getStatusCode());
                        break;
                }
            }
            if ($exception instanceof HttpException) {
                return $this->renderResponse($exception);
            } elseif ($exception instanceof ValidationException) {
                return $this->renderApiResponse($exception);
            }
        }

        return parent::render($request, $exception);
    }
}
