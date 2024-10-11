<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\OwenMediaRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\OwenMediaMail;


class OwenMediaEmailTask implements ShouldQueue
{
    use Queueable;

    protected $registration;
    protected $pdfPath;

    /**
     * Create a new job instance.
     */
    public function __construct(OwenMediaRegistration $registration, $pdfPath)
    {
        $this->registration = $registration;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        Mail::to($this->registration->email)->send(
            new OwenMediaMail($this->pdfPath, $this->registration->name)
        );

    }
}
