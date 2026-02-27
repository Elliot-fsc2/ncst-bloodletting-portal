<?php

namespace App\Actions;

use Spatie\LaravelPdf\Facades\Pdf;

class RedCrossPdfGenerator
{
    public function handle(array $data)
    {
        $surname = strtoupper($data['personal']['surname'] ?? 'donor');
        $givenName = strtoupper($data['personal']['given_name'] ?? '');
        $filename = "RedCross-BloodDonor-{$surname}-{$givenName}.pdf";

        return Pdf::view('pdf.redcross-pdf', ['data' => $data['personal']])
            ->format('a4')
            ->margins(4, 10, 4, 10)
            ->inline($filename);
    }
}
