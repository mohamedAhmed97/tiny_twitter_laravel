<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Services\FollowService;

class FollowController extends Controller
{
    private $followService;
    public function __construct(FollowService $followService)
    {
        $this->middleware('auth:sanctum');
        $this->followService = $followService;
    }

    public function store(Request $request, $follower)
    {
        $this->followService->create($request->user()->id, $follower);
        return response(['message' => 'you followed the user']);
    }
}
