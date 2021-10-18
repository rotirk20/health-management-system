<?php

namespace App\Console\Commands;

use App\Mail\AppointmentReminder;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Carbon\Carbon;


class SendEmailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email reminder to patients day before the appointment day.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();

        $appointments = Appointment::with('patients')->whereDate('appointment', '=', $today->addDay())->get();
        //dd($appointments);
        foreach ($appointments as $app) {
            //dd($app->code);
            foreach($app->patients as $patient) {
                //dd($patient->email);
                Mail::to($patient->email)->send(new AppointmentReminder($app));
            }
        }
    }
}
