<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $patient;
    public $doctor;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $patient, $doctor, $code)
    {
        //
        $this->appointment = $appointment;
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = date('d/m/y H:i', strtotime($this->appointment->appointment));
        return $this->subject('Your appointment is ' . $date)->view('mail.appointment-create');
    }
}
