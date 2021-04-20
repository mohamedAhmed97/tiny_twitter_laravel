<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\FollowResource;
use App\Repository\FollowRepositoryInterface;

class FollowController extends Controller
{
    private $followRepository;
    public function __construct(FollowRepositoryInterface $followRepository)
    {
        $this->middleware('auth:sanctum');
        $this->followRepository = $followRepository;
    }

    public function store(Request $request, $follower_id)
    {
        $this->followRepository->create($request->user()->id, $follower_id);
        return new FollowResource(User::findOrFail($follower_id));
    }
}
