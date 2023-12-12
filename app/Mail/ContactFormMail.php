<?php

// app/Mail/ContactFormMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    public function build()
    {
        return $this->from($this->contactData['email']) // Sender's email
                    ->subject('New Contact Form Submission')
                    ->view('emails.contact') // Create this view with your email template
                    ->with([
                        'contactData' => $this->contactData,
                    ]);
    }
}
