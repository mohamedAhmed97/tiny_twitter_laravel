<?php

namespace App\Services;

use App\Repository\TweetRepositoryInterface;

class TweetService
{
    private $tweetRepository;
    public function __construct(TweetRepositoryInterface $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function create($data, $user_id)
    {   
       return $this->tweetRepository->create($data, $user_id);
    }
}
