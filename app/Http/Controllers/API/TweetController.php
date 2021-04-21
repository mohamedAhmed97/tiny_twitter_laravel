<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\TweetPostRequest;
use App\Http\Resources\TweetResource;
use App\Services\TweetService;

class TweetController extends Controller
{
    private $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->middleware('auth:sanctum');
        $this->tweetService = $tweetService;
    }
    public function store(TweetPostRequest $request)
    {
        $tweet = $this->tweetService->create($request->only(['text']), $request->user()->id);
        return new TweetResource($tweet);
    }
}
