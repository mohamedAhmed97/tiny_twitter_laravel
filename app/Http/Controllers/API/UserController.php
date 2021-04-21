<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;

class UserController extends Controller
{

    private $authService;


    public function __construct(AuthService $authService)
    {
        $this->middleware('throttle:5,30')->only('login');
        $this->authService = $authService;
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
        $data = $request->only([
            'email', 'password', 'device_name'
        ]);
        return $this->authService->handleLogin($data);
    }
}
