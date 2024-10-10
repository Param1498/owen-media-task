<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OwenMediaRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\OwenMediaMail;
use App\Exceptions\CustomCommandException;
use Illuminate\Support\Facades\Log;
class OwenMediaLatestUsers extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "owen:latest {email?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Email functionalty for Owen Media with PDF attachment";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            // Check if the required mail configuration is set
            $this->checkMailConfiguration();
            // Get the email argument from the command line
            $email = $this->argument("email");
            // If an email is provided, send to that specific email address
            if ($email) {
                $registration = OwenMediaRegistration::where(
                    "email",
                    $email
                )->first();

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
        } catch (CustomCommandException $e) {
            // Log the detailed error and show a general message
            $this->error(
                "Invalid mail configuration: There was an issue with the mail configuration. Please check your settings."
            );
            Log::error($e->getMessage()); // Log the detailed error for debugging
        } catch (\Exception $e) {
            // Handle other exceptions
            $this->error(
                "An unexpected error occurred. Please try again later."
            );
            Log::error($e->getMessage()); // Log the detailed error for debugging

        }

        $this->info("Email Custom Command Process has been completed.");
    }

    /**
     * Send email to a specific user/registration.
     *
     * @param OwenMediaRegistration $registration
     */
    protected function sendEmail(OwenMediaRegistration $registration): void
    {
        try {
            // PDF file path
            $pdfPath = storage_path("app/public/" . $registration->file_path);

            // Check if the file exists before sending the email
            if (!file_exists($pdfPath)) {
                $this->error("File not found: {$pdfPath}");
                return;
            }

            // Send the email with the PDF attachment
            Mail::to($registration->email)->send(
                new OwenMediaMail($pdfPath, $registration->name)
            );
            $this->info(
                "Email sent to {$registration->email} with attachment."
            );
        } catch (\Exception $e) {
            $this->error(
                "Failed to send email to {$registration->email}: " .
                    $e->getMessage()
            );
        }
    }
    /**
     * Send emails to the latest two registrations.
     */
    protected function sendEmailsToLatestRegistrations(): void
    {
        // Get the first two records from the database
        $registrations = OwenMediaRegistration::limit(2)->get();

        // Check if there are no registrations found
        if ($registrations->isEmpty()) {
            $this->info("No registrations found.");
            return;
        }

        foreach ($registrations as $registration) {
            $this->sendEmail($registration); // Reuse the common sendEmail method
        }
    }
    /**
     * Check if the mail configuration is set correctly in the .env file.
     *
     * @throws CustomCommandException
     */
    protected function checkMailConfiguration(): void
    {
        $mailMailer = env("MAIL_MAILER");
        $mailHost = env("MAIL_HOST");
        $mailUsername = env("MAIL_USERNAME");
        $mailPassword = env("MAIL_PASSWORD");

        // Check if the configuration is valid
        if (
            $mailMailer !== "smtp" ||
            $mailHost !== "smtp.gmail.com" ||
            !$mailUsername ||
            !$mailPassword
        ) {
            throw new CustomCommandException("Invalid mail configuration: 
               There was an issue with the mail configuration. Please check your settings.");
        }
    }
}
