<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $c_name;
    protected $c_email;
    protected $c_phone;
    protected $cargo_name;
    protected $cargo_price;
    protected $cargo_weight;
    protected $invoice_number;
    protected $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice_number, $date, $c_name, $c_phone, $c_email, $cargo_name, $cargo_price, $cargo_weight)
    {
        $this->invoice_number = $invoice_number;
        $this->date = $date;
        $this->c_email = $c_email;
        $this->c_name = $c_name;
        $this->c_phone = $c_phone;
        $this->cargo_name = $cargo_name;
        $this->cargo_price = $cargo_price;
        $this->cargo_weight = $cargo_weight;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.mail')->with('email', $this->c_email)
            ->with('invoice_number', $this->invoice_number)
            ->with('date', $this->date)
            ->with('name', $this->c_name)
            ->with('phone', $this->c_phone)
            ->with('cargo_name', $this->cargo_name)
            ->with('cargo_price', $this->cargo_price)
            ->with('cargo_weight', $this->cargo_weight);
    }
}
