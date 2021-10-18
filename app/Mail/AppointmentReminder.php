<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class AppointmentReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $appointments;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointments)
    {
        //
        $this->appointments = $appointments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $time = date('H:i', strtotime($this->appointments->appointment));
        return $this->subject('Your appointment is tomorrow at ' . $time . ' - Reminder')->view('mail.appointment-reminder');
    }
}
