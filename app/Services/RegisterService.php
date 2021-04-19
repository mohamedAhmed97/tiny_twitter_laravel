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
        $user_avatar_name = time() . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs(
            'public/user',
            $user_avatar_name
        );
        return $this->userRepository->create($request, $user_avatar_name);
    }
}
