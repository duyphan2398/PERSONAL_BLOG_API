<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\CMSLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Transformers\AdminTransformer;
use Carbon\Carbon;
use Flugg\Responder\Exceptions\Http\UnauthenticatedException;

class AuthController extends ApiController
{
    /**
     * @param \App\Http\Requests\CMSLoginRequest $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if ((! $token = auth()->attempt($request->validated()))) {
            throw new UnauthenticatedException(trans('auth.failed'));
        }

        return $this->httpResponse([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Carbon::parse(auth()->payload()->get('exp'))->format('d/m/y H:i'),
        ]);
    }

    /**
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function profile()
    {
        return $this->httpOK(auth()->user(),
            AdminTransformer::class);
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        auth()->logout();

        return $this->httpNoContent();
    }
}
