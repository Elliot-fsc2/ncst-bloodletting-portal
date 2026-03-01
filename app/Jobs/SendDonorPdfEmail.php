<?php

namespace App\Jobs;

use App\Mail\FormSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\LaravelPdf\Facades\Pdf;

class SendDonorPdfEmail implements ShouldQueue
{
  use Queueable;

  public function __construct(
    public string $donorName,
    public string $donorEmail,
    public string $filename,
    public array $pdfData,
  ) {
  }

  public function handle(): void
  {
    $pdfSubpath = 'vmmc/' . $this->filename;
    $pdfAbsolutePath = Storage::disk('local')->path('private/pdfs/' . $pdfSubpath);

    File::ensureDirectoryExists(Storage::disk('local')->path('private/pdfs/vmmc'));

    Pdf::view('pdf.vmmc-pdf', ['data' => $this->pdfData])
      ->margins(4, 10, 4, 10)
      ->format('a4')
      ->save($pdfAbsolutePath);

    $downloadUrl = URL::temporarySignedRoute('pdf.download', now()->addDays(7), ['path' => $pdfSubpath]);

    Mail::to($this->donorEmail)->send(new FormSubmitted($this->donorName, $downloadUrl));
  }
}
