<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotification;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $appointments = Appointment::with(['doctors', 'patients'])->orderBy('appointment', 'asc')->paginate($perPage);
        if ($appointments === null) {
            return view('appointments.index');
        } else {
            return view('appointments.index', ['appointments' => $appointments, 'perPage' => $perPage]);
        }
    }

    //Time intervals

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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::pluck('name', 'id')->toArray();
        $doctors = Doctor::pluck('name', 'id')->toArray();
        $times = $this->create_time_range('7:30', '18:30', '30 mins', '24');
        return view('appointments.create', ['patients' => $patients, 'doctors' => $doctors, 'times' => $times]);
    }


    public function checkDate(Request $request)

    {
        $date = $request->all();
        $appointments = Appointment::whereDate('appointment', '=', $date)->get();
        $reservedTimes = array();
        foreach ($appointments as $appointment) {
            $reservedTimes[] = ltrim(Carbon::createFromFormat('Y-m-d H:i:s', $appointment->appointment)->format('H:i'), 0);
        }
        return response()->json($reservedTimes);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'appointment' => 'required',
            'patient_id' => 'required',
            'doctor_id' => 'required'
        ]);

        $appointment = new Appointment();
        //On left field name in DB and on right field name in Form/view
        $appointment->appointment = $request->input('time');
        $appointment->patient_id = $request->input('patient_id');
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->code = $this->generateUniqueCode();
        $code = $appointment->code;
        $appointment->save();
        $patient = Patient::with('appointments')->where('id', '=', $appointment->patient_id)->first();
        $doctor = Doctor::with('appointments')->where('id', '=', $appointment->doctor_id)->first();
        Mail::to($patient->email)->send(new MailNotification($appointment, $patient, $doctor, $code));
        return redirect('appointments')->with('success', 'Appointment successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        $patient = Patient::with('appointments')->where('id', '=', $appointment->patient_id)->first();
        $doctor = Doctor::with('appointments')->where('id', '=', $appointment->doctor_id)->first();
        return view('appointments.view', ['appointment' => $appointment, 'patient' => $patient, 'doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::where('id', '=', $id)->first();
        $date = strtotime($appointment->getAttributes()['appointment']);
        $formatDate = date('Y-m-d', $date);
        $time = date('H:i', $date);
        $time = ltrim($time, '0');
        $times = $this->create_time_range('7:30', '18:30', '30 mins', '24');
        $patients = Patient::pluck('name', 'id')->toArray();
        $doctors = Doctor::pluck('name', 'id')->toArray();
        return view('appointments.edit', ['patients' => $patients, 'doctors' => $doctors, 'appointment' => $appointment, 'date' => $formatDate, 'timeHours' => $time, 'times' => $times]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($request->id);
        $appointment->appointment = $request->input('time');
        $appointment->patient_id = $request->input('patient_id');
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->save();
        return redirect('/appointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $app = Appointment::find($id);
        $app->delete();
        return redirect('appointments');
    }

    public function search(Request $request)
    {
        $search = $request->input('code');
        //dd($search);
        $appointments = Appointment::query('code')->where('code', '=', $search)->first();
        //dd($appointments);
        if ($appointments != null) {
            $patient = Patient::find($appointments->patient_id);
            $doctor = Doctor::find($appointments->doctor_id);
            return view('welcome', ['appointments' => $appointments, 'patient' => $patient, 'doctor' => $doctor, 'search' => $search]);
        }
        //dd($patient);
        return view('welcome', ['appointments' => $appointments, 'search' => $search]);
    }
}
