<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tweet\TweetPostRequest;
use App\Models\Tweet;
use App\Repository\Eloquent\TweetRepository;
use App\Http\Resources\TweetResource;

class TweetController extends Controller
{
    private $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->middleware('auth:sanctum');
        $this->tweetRepository = $tweetRepository;
    }
    public function store(TweetPostRequest $request)
    {
        $data = $request->only(['text']);
        $tweet = $this->tweetRepository->create($data,$request->user()->id);
        return new TweetResource($tweet);
    }
}
