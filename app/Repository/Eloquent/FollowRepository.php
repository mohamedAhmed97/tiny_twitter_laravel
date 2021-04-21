<?php

namespace App\Repository\Eloquent;

use App\Repository\FollowRepositoryInterface;
use App\Models\User;

class FollowRepository implements FollowRepositoryInterface
{
    public function create($userId, $followerId)
    {
        return User::findOrFail($userId)->followers()->syncWithoutDetaching(User::findOrFail($followerId));
    }
}
