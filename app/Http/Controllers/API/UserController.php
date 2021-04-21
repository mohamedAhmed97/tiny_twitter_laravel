<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\UserRepositoryInterface;
use App\Repository\Elquent\UserRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\LoginService;
use App\Services\RegisterService;

class UserController extends Controller
{

    private $loginService;
    private $registerService;

    public function __construct(RegisterService $registerService, LoginService $loginService)
    {
        $this->middleware('throttle:3,30')->only('login');
        $this->loginService = $loginService;
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only([
            'email', 'name', 'password',
            'passowrd_confirmation',
            'date_of_birth', 'image'
        ]);
        $user = $this->registerService->handleRegister($data);
        return new UserResource($user);
    }

    function login(LoginRequest $request)
    {
        $data = $request->only([
            'email', 'password', 'device_name'
        ]);
        return $this->loginService->handle($data);
    }
}
