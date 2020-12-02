<?php

namespace App\Traits;

use Flugg\Responder\Exceptions\Http\HttpException;
use Flugg\Responder\Exceptions\Http\PageNotFoundException;
use Flugg\Responder\Exceptions\Http\RelationNotFoundException;
use Flugg\Responder\Exceptions\Http\UnauthenticatedException;
use Flugg\Responder\Exceptions\Http\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException as BaseRelationNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait HandleErrorException
{
    /**
     * @param \Illuminate\Validation\ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function renderApiResponse(ValidationException $exception): JsonResponse
    {
        return response()->json([
            'code'    => JsonResponse::HTTP_BAD_REQUEST,
            'message' => trans('api.validation.message'),
            'errors'  => $this->convertApiErrors($exception->errors()),
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Render an error response from an API exception.
     *
     * @param \Flugg\Responder\Exceptions\Http\HttpException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function renderResponse(HttpException $exception): JsonResponse
    {
        return response()->json([
            'code'    => $exception->statusCode(),
            'message' => $exception->message() ?? trans('api.msg_err_'.$exception->statusCode()),
        ], $exception->statusCode());
    }

    /**
     * @param $errors
     * @return array
     */
    private function convertApiErrors($errors)
    {
        $result = [];
        foreach ($errors as $k => $error) {
            $result[] = [
                'field'   => $k,
                'message' => last($error),
            ];
        }

        return $result;
    }

    /**
     * Convert an exception to another exception
     *
     * @param \Exception|\Throwable $exception
     * @param array $convert
     * @return void
     */
    protected function convert($exception, array $convert)
    {
        foreach ($convert as $source => $target) {
            if ($exception instanceof $source) {
                if (is_callable($target)) {
                    $target($exception);
                }

                throw new $target;
            }
        }
    }

    /**
     * Convert a default exception to an API exception.
     *
     * @param \Exception|\Throwable $exception
     * @return void
     */
    protected function convertDefaultException($exception)
    {
        $this->convert($exception, [
            AuthenticationException::class       => UnauthenticatedException::class,
            AuthorizationException::class        => UnauthorizedException::class,
            NotFoundHttpException::class         => PageNotFoundException::class,
            ModelNotFoundException::class        => PageNotFoundException::class,
            BaseRelationNotFoundException::class => RelationNotFoundException::class,
        ]);
    }
}
