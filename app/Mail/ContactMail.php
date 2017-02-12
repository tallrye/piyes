<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $subject, $body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@project.com')
                ->subject($this->subject)
                ->markdown('emails.contact')
                ->with(['name' => $this->name, 'email' => $this->email, 'phone' => $this->phone, 'body' => $this->body]);
    }
}
