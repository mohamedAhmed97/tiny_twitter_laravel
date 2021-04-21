<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Services\PDFService;

class ReportController extends Controller
{
    private $pdfService;
    public function __construct(PDFService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function downloadPDF()
    {
        return $this->pdfService->handlePDF();
    }
}
