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
        $this->middleware('throttle:3,1')->only('login');
        $this->loginService = $loginService;
        $this->registerService=$registerService;

    }

    public function register(RegisterRequest $request)
    {
        $user=$this->registerService->handleRegister($request);
        return new UserResource($user);
    }

    function login(LoginRequest $request)
    {
        return $this->loginService->handle($request);
    }
}
