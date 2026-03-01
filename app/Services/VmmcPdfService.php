<?php

namespace App\Services;

use Spatie\LaravelPdf\Facades\Pdf;

class VmmcPdfService
{
  /**
   * Generate the VMMC Blood Donor PDF and return it as an inline response.
   */
  public function inline(array $data)
  {
    $surname = strtoupper($data['personal']['surname'] ?? 'donor');
    $givenName = strtoupper($data['personal']['given_name'] ?? '');
    $filename = "VMMC-BloodDonor-{$surname}-{$givenName}.pdf";

    return Pdf::view('pdf.vmmc-pdf', compact('data'))
      ->margins(4, 10, 4, 10)
      ->format('a4')
      ->inline($filename);
  }
}
