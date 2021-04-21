<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;

class RegisterService
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handleRegister($request)
    {
        // dd($request);
        $user_avatar_name = time() . $request['image']->getClientOriginalName();
        $path = $request['image']->storeAs(
            'public/user',
            $user_avatar_name
        );
        return $this->userRepository->create($request, $user_avatar_name);
    }
}
