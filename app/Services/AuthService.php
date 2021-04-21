<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthService
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handleRegister($data, $img)
    {
        $userAvatarName = time() . $img->getClientOriginalName();
        $img->storeAs(
            'public/user',
            $userAvatarName
        );
        return $this->userRepository->create($data, $userAvatarName);
    }

    public function handleLogin($data)
    {
        $user = $this->userRepository->findByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
      
        return $user->createToken($data['device_name'])->plainTextToken;
    }
}
