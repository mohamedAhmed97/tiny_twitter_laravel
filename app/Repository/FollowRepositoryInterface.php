<?php

namespace App\Repository;

interface FollowRepositoryInterface
{
    public function create($user_id, $follower_id);
}
