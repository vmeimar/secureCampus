<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Εγγραφή Χρήστη στην Πλατφόρμα Secure Campus')
                    ->from('ΕΚΠΑ Secure Campus')
                    ->markdown('emails.register-email', [
                                    'token'    =>  $this->token,
                                ]);
    }
}
