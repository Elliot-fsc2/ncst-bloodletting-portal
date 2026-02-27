<?php

namespace App\Http\Controllers;

use App\Services\VmmcPdfService;
use Illuminate\Http\Request;

class PDFGenerator extends Controller
{
    public function __invoke(Request $request, VmmcPdfService $service)
    {
        return $service->inline($request->json()->all());
    }
}
