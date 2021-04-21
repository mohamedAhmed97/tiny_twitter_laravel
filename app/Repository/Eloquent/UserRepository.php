<?php

namespace App\Repository\Eloquent;

use App\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function getAll()
    {
      return User::all();
    }
    
    public function create($data,$imageName)
    {
       return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'image' => $imageName,
            'date_of_birth' => $data->date_of_birth
        ]);
    }


    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
