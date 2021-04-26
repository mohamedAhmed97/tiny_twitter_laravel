<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Traits\ThrottlesLogins;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ThrottlesLogins;
    public $decayMinutes = 30;
    private $authService;


    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    protected function checkMaximumAttempts($request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }
    }

    
    public function register(RegisterRequest $request)
    {
        $data = $request->only([
            'email', 'name', 'password',
            'passowrd_confirmation',
            'date_of_birth',
        ]);
        $user = $this->authService->handleRegister($data, $request->file('image'));
        return new UserResource($user);
    }


    function login(LoginRequest $request)
    {
        $this->checkMaximumAttempts($request);
        $user = $this->authService->handleLogin($request->only(['email', 'password', 'device_name']));
        if (!$user) {
            $this->incrementLoginAttempts($request);
            throw ValidationException::withMessages(['email' => 'the credentials is invalid']);
        }

        $this->clearLoginAttempts($request);

        return response(['user' => new UserResource($user), 'token' => new TokenResource($user->createToken('web'))]);
    }
}
