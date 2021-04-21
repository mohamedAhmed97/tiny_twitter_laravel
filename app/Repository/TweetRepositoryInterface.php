<?php

namespace App\Repository;

interface TweetRepositoryInterface
{
    public function create($data,$user_id);
    public function countTweets();

}
