<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\TweetRepository;
use Barryvdh\DomPDF\Facade as PDF;

class PDFService
{
    private $userRepository;
    private $tweetRepository;
    public function __construct(UserRepositoryInterface $userRepository, TweetRepository $tweetRepository)
    {
        $this->userRepository = $userRepository;
        $this->tweetRepository = $tweetRepository;
    }

    public function handlePDF()
    {
        $users = $this->userRepository->getAll();
        $tweetsCount = $this->tweetRepository->countTweets();
        $tweetsPerUSer = $tweetsCount/count($users) ;
        $pdf = PDF::loadView('pdf', compact('users', 'tweetsPerUSer'));
        return $pdf->download('report.pdf');
    }
}
