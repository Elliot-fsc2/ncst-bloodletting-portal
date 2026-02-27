<?php

namespace App\Http\Controllers;

use App\Actions\RedCrossPdfGenerator;
use App\Actions\TSMCPdfGenerator;
use App\Services\VmmcPdfService;
use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
{
    public function vmmc(Request $request, VmmcPdfService $service)
    {
        return $service->inline($request->json()->all());
    }

    public function tsmc(Request $request, TSMCPdfGenerator $generator)
    {
        return $generator->handle($request->json()->all());
    }

    public function redcross(Request $request, RedCrossPdfGenerator $generator)
    {
        return $generator->handle($request->json()->all());
    }
}
