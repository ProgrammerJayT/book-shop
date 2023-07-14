<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceOrderMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $pdf;
    public $maildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $maildata)
    {
        $this->pdf = $pdf;
        $this->maildata = $maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mailables.invoice')->with('maildata',$this->maildata)->attachData($this->pdf->output(), 'Invoice.pdf');
    }
}
