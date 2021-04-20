<?php

namespace App\Repository\Eloquent;

use App\Repository\FollowRepositoryInterface;
use App\Models\User;
class FollowRepository implements FollowRepositoryInterface
{
    public function create($user_id,$follower_id)
    {
        return User::findOrFail($user_id)->followers()->attach(User::findOrFail($follower_id));

    }
}
