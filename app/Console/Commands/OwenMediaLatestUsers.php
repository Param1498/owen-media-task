<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OwenMediaRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\OwenMediaMail;
use App\Exceptions\CustomCommandException;




class OwenMediaLatestUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'owen:latest {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email functionalty for Owen Media with PDF attachment';

   /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Get the email argument from the command line
        $email = $this->argument('email');

        // If an email is provided, send to that specific email address
        if ($email) {
            $registration = OwenMediaRegistration::where('email', $email)->first();

            if (!$registration) {
                $this->error("No registration found for email: {$email}");
                return;
            }

            // Send the email to the specific address
            $this->sendEmail($registration);
        } 
        // Otherwise, get the first two records and send emails
        else {
            $this->sendEmailsToLatestRegistrations();
        }

        $this->info('Email Custom Command Process has been completed.');
    }

     /**
     * Send email to a specific user/registration.
     *
     * @param OwenMediaRegistration $registration
     */
    protected function sendEmail(OwenMediaRegistration $registration) : void
    {
        try {
            // Construct the PDF file path
            $pdfPath = storage_path('app/public/' . $registration->file_path);

            // Check if the file exists before sending the email
            if (!file_exists($pdfPath)) {
                $this->error("File not found: {$pdfPath}");
                return;
            }

            // Send the email with the PDF attachment
            Mail::to($registration->email)->send(new OwenMediaMail($pdfPath, $registration->name));
            $this->info("Email sent to {$registration->email} with attachment.");
        } catch (CustomCommandException $e) {
            $this->error("Failed to send email to {$registration->email}: " . $e->getMessage());
        }
    }
     /**
     * Send emails to the latest two registrations.
     */
    protected function sendEmailsToLatestRegistrations() : void
    {
        // Get the first two records from the database
        $registrations = OwenMediaRegistration::limit(2)->get();

        // Check if there are no registrations found
        if ($registrations->isEmpty()) {
            $this->info('No registrations found.');
            return;
        }

        foreach ($registrations as $registration) {
            $this->sendEmail($registration); // Reuse the common sendEmail method
        }
    }
}
