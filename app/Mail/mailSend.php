<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->details['flag']=='toUser')
            {
                return $this->subject("Ineed! Your Offer Has been Selected")->view('emails.sendMailTemp');
            }
        if($this->details['flag']=='toSupport')
            {
                return $this->subject("Ineed! New Ticket Arrived!")->view('emails.sendMailTempSupport');
            } 
        if($this->details['flag']=='toMe')
            {
                return $this->subject("Ineed! You Ticket has been Place")->view('emails.sendMailToMe');
            }
    }
}
