<?php

namespace App\Repository\Eloquent;

use App\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function getAll()
    {
        return User::with('tweets')->get();
    }

    public function create($data, $imageName)
    {
        $data['image'] = $imageName;
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }


    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

}
