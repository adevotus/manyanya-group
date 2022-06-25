<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $c_name;
    protected $c_email;
    protected $c_phone;
    protected $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($c_name, $c_phone, $c_email, $reply)
    {
        $this->c_email = $c_email;
        $this->c_name = $c_name;
        $this->c_phone = $c_phone;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.qoute')
            ->with('email', $this->c_email)
            ->with('name', $this->c_name)
            ->with('phone', $this->c_phone)
            ->with('reply', $this->reply);
    }
}
