<?php

use App\Jobs\SendDonorPdfEmail;
use App\Jobs\SendEacmedDonorPdfEmail;
use App\Jobs\SendPghDonorPdfEmail;
use App\Jobs\SendRedCrossDonorPdfEmail;
use App\Jobs\SendTsmcDonorPdfEmail;
use App\Jobs\SendUmcDonorPdfEmail;
use App\Mail\FormSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;

// ─── Helpers ──────────────────────────────────────────────────────────────────

function mockPdfChain(bool $withFormat = true): void
{
    $pdfMock = Mockery::mock(PdfBuilder::class);
    $pdfMock->shouldReceive('margins')->once()->andReturnSelf();
    if ($withFormat) {
        $pdfMock->shouldReceive('format')->once()->andReturnSelf();
    }
    $pdfMock->shouldReceive('save')->once();

    Pdf::shouldReceive('view')->once()->andReturn($pdfMock);
}

function mockFileAndUrl(): void
{
    File::shouldReceive('ensureDirectoryExists')->once();
    URL::shouldReceive('temporarySignedRoute')->once()->andReturn('https://example.com/download/test.pdf');
}

// ─── SendDonorPdfEmail (VMMC) ─────────────────────────────────────────────────

describe('SendDonorPdfEmail (VMMC)', function () {
    it('implements ShouldQueue', function () {
        $job = new SendDonorPdfEmail('John Doe', 'john@example.com', 'vmmc_test.pdf', []);

        expect($job)->toBeInstanceOf(ShouldQueue::class);
    });

    it('can be dispatched to the queue with correct properties', function () {
        Queue::fake();

        SendDonorPdfEmail::dispatch('John Doe', 'john@example.com', 'vmmc_test.pdf', [
            'queue_number' => '001',
            'preferred_date' => '2026-03-10',
        ]);

        Queue::assertPushed(SendDonorPdfEmail::class, function ($job) {
            return $job->donorName === 'John Doe'
                && $job->donorEmail === 'john@example.com'
                && $job->filename === 'vmmc_test.pdf';
        });
    });

    it('sends FormSubmitted email to donor on handle', function () {
        Mail::fake();
        Storage::fake('local');
        mockFileAndUrl();
        mockPdfChain();

        $job = new SendDonorPdfEmail('John Doe', 'john@example.com', 'vmmc_test.pdf', [
            'queue_number' => '001',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->hasTo('john@example.com') && $mail->donorName === 'John Doe';
        });
    });

    it('sends email with a signed download URL', function () {
        Mail::fake();
        Storage::fake('local');
        File::shouldReceive('ensureDirectoryExists')->once();
        URL::shouldReceive('temporarySignedRoute')
            ->once()
            ->andReturn('https://example.com/download/vmmc/vmmc_test.pdf');

        $pdfMock = Mockery::mock(PdfBuilder::class);
        $pdfMock->shouldReceive('margins')->once()->andReturnSelf();
        $pdfMock->shouldReceive('format')->once()->andReturnSelf();
        $pdfMock->shouldReceive('save')->once();
        Pdf::shouldReceive('view')->once()->andReturn($pdfMock);

        $job = new SendDonorPdfEmail('John Doe', 'john@example.com', 'vmmc_test.pdf', [
            'queue_number' => '001',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->url === 'https://example.com/download/vmmc/vmmc_test.pdf';
        });
    });
});

// ─── SendEacmedDonorPdfEmail (EACMED) ─────────────────────────────────────────

describe('SendEacmedDonorPdfEmail (EACMED)', function () {
    it('implements ShouldQueue', function () {
        $job = new SendEacmedDonorPdfEmail('Jane Doe', 'jane@example.com', 'eacmed_test.pdf', []);

        expect($job)->toBeInstanceOf(ShouldQueue::class);
    });

    it('can be dispatched to the queue with correct properties', function () {
        Queue::fake();

        SendEacmedDonorPdfEmail::dispatch('Jane Doe', 'jane@example.com', 'eacmed_test.pdf', [
            'queue_number' => '002',
            'preferred_date' => '2026-03-10',
        ]);

        Queue::assertPushed(SendEacmedDonorPdfEmail::class, function ($job) {
            return $job->donorName === 'Jane Doe'
                && $job->donorEmail === 'jane@example.com'
                && $job->filename === 'eacmed_test.pdf';
        });
    });

    it('sends FormSubmitted email to donor on handle (no format step)', function () {
        Mail::fake();
        Storage::fake('local');
        mockFileAndUrl();
        mockPdfChain(withFormat: false); // EACMED does not call ->format()

        $job = new SendEacmedDonorPdfEmail('Jane Doe', 'jane@example.com', 'eacmed_test.pdf', [
            'queue_number' => '002',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->hasTo('jane@example.com') && $mail->donorName === 'Jane Doe';
        });
    });
});

// ─── SendPghDonorPdfEmail (PGH) ───────────────────────────────────────────────

describe('SendPghDonorPdfEmail (PGH)', function () {
    it('implements ShouldQueue', function () {
        $job = new SendPghDonorPdfEmail('Pedro Cruz', 'pedro@example.com', 'pgh_test.pdf', []);

        expect($job)->toBeInstanceOf(ShouldQueue::class);
    });

    it('can be dispatched to the queue with correct properties', function () {
        Queue::fake();

        SendPghDonorPdfEmail::dispatch('Pedro Cruz', 'pedro@example.com', 'pgh_test.pdf', [
            'queue_number' => '003',
            'preferred_date' => '2026-03-10',
        ]);

        Queue::assertPushed(SendPghDonorPdfEmail::class, function ($job) {
            return $job->donorName === 'Pedro Cruz'
                && $job->donorEmail === 'pedro@example.com'
                && $job->filename === 'pgh_test.pdf';
        });
    });

    it('sends FormSubmitted email to donor on handle', function () {
        Mail::fake();
        Storage::fake('local');
        mockFileAndUrl();
        mockPdfChain();

        $job = new SendPghDonorPdfEmail('Pedro Cruz', 'pedro@example.com', 'pgh_test.pdf', [
            'queue_number' => '003',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->hasTo('pedro@example.com') && $mail->donorName === 'Pedro Cruz';
        });
    });
});

// ─── SendRedCrossDonorPdfEmail (Red Cross) ────────────────────────────────────

describe('SendRedCrossDonorPdfEmail (Red Cross)', function () {
    it('implements ShouldQueue', function () {
        $job = new SendRedCrossDonorPdfEmail('Maria Santos', 'maria@example.com', 'redcross_test.pdf', []);

        expect($job)->toBeInstanceOf(ShouldQueue::class);
    });

    it('can be dispatched to the queue with correct properties', function () {
        Queue::fake();

        SendRedCrossDonorPdfEmail::dispatch('Maria Santos', 'maria@example.com', 'redcross_test.pdf', [
            'personal' => ['first_name' => 'Maria'],
            'queue_number' => '004',
            'preferred_date' => '2026-03-10',
        ]);

        Queue::assertPushed(SendRedCrossDonorPdfEmail::class, function ($job) {
            return $job->donorName === 'Maria Santos'
                && $job->donorEmail === 'maria@example.com'
                && $job->filename === 'redcross_test.pdf';
        });
    });

    it('sends FormSubmitted email to donor on handle (uses pdfData[personal])', function () {
        Mail::fake();
        Storage::fake('local');
        mockFileAndUrl();
        mockPdfChain();

        $job = new SendRedCrossDonorPdfEmail('Maria Santos', 'maria@example.com', 'redcross_test.pdf', [
            'personal' => ['first_name' => 'Maria', 'last_name' => 'Santos'],
            'queue_number' => '004',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->hasTo('maria@example.com') && $mail->donorName === 'Maria Santos';
        });
    });
});

// ─── SendTsmcDonorPdfEmail (TSMC) ─────────────────────────────────────────────

describe('SendTsmcDonorPdfEmail (TSMC)', function () {
    it('implements ShouldQueue', function () {
        $job = new SendTsmcDonorPdfEmail('Carlos Reyes', 'carlos@example.com', 'tsmc_test.pdf', []);

        expect($job)->toBeInstanceOf(ShouldQueue::class);
    });

    it('can be dispatched to the queue with correct properties', function () {
        Queue::fake();

        SendTsmcDonorPdfEmail::dispatch('Carlos Reyes', 'carlos@example.com', 'tsmc_test.pdf', [
            'personal' => ['first_name' => 'Carlos'],
            'queue_number' => '005',
            'preferred_date' => '2026-03-10',
        ]);

        Queue::assertPushed(SendTsmcDonorPdfEmail::class, function ($job) {
            return $job->donorName === 'Carlos Reyes'
                && $job->donorEmail === 'carlos@example.com'
                && $job->filename === 'tsmc_test.pdf';
        });
    });

    it('sends FormSubmitted email to donor on handle (uses pdfData[personal])', function () {
        Mail::fake();
        Storage::fake('local');
        mockFileAndUrl();
        mockPdfChain();

        $job = new SendTsmcDonorPdfEmail('Carlos Reyes', 'carlos@example.com', 'tsmc_test.pdf', [
            'personal' => ['first_name' => 'Carlos', 'last_name' => 'Reyes'],
            'queue_number' => '005',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->hasTo('carlos@example.com') && $mail->donorName === 'Carlos Reyes';
        });
    });
});

// ─── SendUmcDonorPdfEmail (UMC / DLSU) ───────────────────────────────────────

describe('SendUmcDonorPdfEmail (UMC)', function () {
    it('implements ShouldQueue', function () {
        $job = new SendUmcDonorPdfEmail('Ana Lopez', 'ana@example.com', 'umc_test.pdf', []);

        expect($job)->toBeInstanceOf(ShouldQueue::class);
    });

    it('can be dispatched to the queue with correct properties', function () {
        Queue::fake();

        SendUmcDonorPdfEmail::dispatch('Ana Lopez', 'ana@example.com', 'umc_test.pdf', [
            'queue_number' => '006',
            'preferred_date' => '2026-03-10',
        ]);

        Queue::assertPushed(SendUmcDonorPdfEmail::class, function ($job) {
            return $job->donorName === 'Ana Lopez'
                && $job->donorEmail === 'ana@example.com'
                && $job->filename === 'umc_test.pdf';
        });
    });

    it('sends FormSubmitted email to donor on handle', function () {
        Mail::fake();
        Storage::fake('local');
        mockFileAndUrl();
        mockPdfChain();

        $job = new SendUmcDonorPdfEmail('Ana Lopez', 'ana@example.com', 'umc_test.pdf', [
            'queue_number' => '006',
            'preferred_date' => '2026-03-10',
        ]);
        $job->handle();

        Mail::assertSent(FormSubmitted::class, function ($mail) {
            return $mail->hasTo('ana@example.com') && $mail->donorName === 'Ana Lopez';
        });
    });
});
