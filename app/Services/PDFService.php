<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use PDF;

class PDFService
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handlePDF()
    {
        $users = $this->userRepository->getAll();
        $pdf = PDF::loadView('pdf', compact('users'));
        return $pdf->download('report.pdf');
    }
}
