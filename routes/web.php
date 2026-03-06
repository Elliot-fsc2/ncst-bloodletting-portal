<?php

use App\Http\Controllers\PdfGeneratorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

Route::fallback(function () {
  return redirect()->route('home');
});

Route::livewire('/', 'guest::donation-form')->name('home');

Route::view('/vmmc-pdf', 'pdf.vmmc-pdf');
Route::view('/umc-pdf', 'pdf.umc-pdf');
Route::view('/redcross-pdf', 'pdf.redcross-pdf');
Route::view('/tsmc-pdf', 'pdf.tsmc-pdf');
Route::view('/eacmed-pdf', 'pdf.eacmed-pdf');
Route::view('/pgh-pdf', 'pdf.pgh-pdf');

Route::get('/download-pdf/{path}', function (string $path) {

  $storagePath = 'private/pdfs/' . $path;

  if (!Storage::disk('local')->exists($storagePath)) {
    abort(404, 'File not found.');
  }

  return response()->download(Storage::disk('local')->path($storagePath));
})->where('path', '.+')->name('pdf.download')->middleware('signed');

Route::get('/pdf-ready/{path}', function (string $path) {

  $storagePath = 'private/pdfs/' . $path;

  if (!Storage::disk('local')->exists($storagePath)) {
    abort(404, 'File not found or the link has expired.');
  }

  $downloadUrl = URL::temporarySignedRoute('pdf.download', now()->addMinutes(30), ['path' => $path]);

  return view('pdf.download-landing', compact('downloadUrl'));
})->where('path', '.+')->name('pdf.landing')->middleware('signed');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
