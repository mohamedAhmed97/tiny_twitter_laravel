<?php

namespace App\Services;

use App\Repository\FollowRepositoryInterface;
use Illuminate\Validation\ValidationException;

class FollowService
{
    private $followRepository;
    public function __construct(FollowRepositoryInterface $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function create($userId, $follower)
    {
        if ($userId == $follower) {
            throw ValidationException::withMessages([
                'error' => ['You Cant Follow Yourself.'],
            ]);
        }
        $this->followRepository->create($userId, $follower);
    }
}
