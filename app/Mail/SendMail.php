<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    // Constructor accepts the array
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        $subject = $this->mailData['title'];
        $otp = $this->mailData['body']; // The actual OTP code

        return $this->subject($subject)
                    ->html("<h1>Your OTP is: <b>$otp</b></h1>");
    }
}