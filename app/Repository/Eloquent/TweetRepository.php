<?php

namespace App\Repository\Eloquent;

use App\Repository\TweetRepositoryInterface;
use App\Models\Tweet;

class TweetRepository implements TweetRepositoryInterface
{
    public function create($data,$user_id)
    {
        return Tweet::create([
            'text' => $data['text'],
            'user_id' => $user_id
        ]);
    }
}
