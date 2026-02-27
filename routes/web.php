<?php

use App\Http\Controllers\PdfGeneratorController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'guest::donation-form')->name('home');

// PDF generation — data is POSTed as JSON from $this->js() fetch() in the Livewire component
Route::post('/vmmc-pdf', [PdfGeneratorController::class, 'vmmc'])->name('vmmc.pdf');
Route::post('/tsmc-pdf', [PdfGeneratorController::class, 'tsmc'])->name('tsmc.pdf');
Route::view('/redcross-pdf', 'pdf.redcross-pdf')->name('redcross.pdf');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
