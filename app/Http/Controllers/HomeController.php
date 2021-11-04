<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirm;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function create_time_range($start, $end, $interval = '30 mins', $format = '12')
    {
        $startTime = strtotime($start);
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '12') ? 'g:i A' : 'G:i';

        $current   = time();
        $addTime   = strtotime('+' . $interval, $current);
        $diff      = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        return $times;
    }

    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }


        if (Appointment::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }


    public function store_appointment(Request $request)
    {
        $patient = Patient::where('email', '=', $request->input('email'))->first();
        if ($patient == null) {
            $newPatient = new Patient();
            $newPatient->address = 'Test';
            $newPatient->birthdate = date("Y-m-d");
            $newPatient->city = "Zenica";
            $newPatient->phone = "+38762759299";
            $newPatient->name = $request->input('name');
            $newPatient->email = $request->input('email');
            $newPatient->save();

            $appointment = new Appointment();
            $appointment->appointment = $request->input('time');
            $appointment->patient_id = $newPatient->id;
            $appointment->description = "Reservation through home";
            $appointment->doctor_id = 1;
            $appointment->code = $this->generateUniqueCode();
            Mail::to($patient->email)->send(new AppointmentConfirm($appointment->code));
            $appointment->save();
        } else {
            $appointment = new Appointment();
            $appointment->appointment = $request->input('time');
            $appointment->patient_id = $patient->id;
            $appointment->description = "Reservation through home";
            $appointment->doctor_id = 1;
            $appointment->code = $this->generateUniqueCode();
            Mail::to($patient->email)->send(new AppointmentConfirm($appointment->code));
            $appointment->save();
        }
        return redirect('/')->with('success', 'Appointment successfully created.');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $settings = DB::table('settings')->first();
        $times = $this->create_time_range($settings->start_time, $settings->end_time, $settings->interval, $settings->format);
        $times = array_diff($times, [$settings->pause_time]);
        $search = $request->input('code');
        $appointments = Appointment::query('code')->where('code', '=', $search)->first();
        if ($appointments != null) {
            $patient = Patient::find($appointments->patient_id);
            $doctor = Doctor::find($appointments->doctor_id);
            return view('welcome', ['appointments' => $appointments, 'patient' => $patient, 'doctor' => $doctor, 'search' => $search, 'times' => $times]);
        }
        return view('welcome', ['appointments' => $appointments, 'search' => $search, 'times' => $times]);
    }

    public function verify(Request $request, $code)
    {
        return view('appointments.verify', ['code' => $code]);
    }

    public function verifyAppointment(Request $request)
    {  
        $code = $request->except('_token');
        $appointment = Appointment::where('code', $code)->first();
        dd($appointment);
        return view('appointments.verify');
    }
}
