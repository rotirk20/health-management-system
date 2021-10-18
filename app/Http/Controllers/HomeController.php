<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $appointmentsToday = Appointment::whereDate('appointment', '=', date('Y-m-d'))->count();
        $appointments = Appointment::all()->count();
        $patients = Patient::all()->count();
        $doctors = Doctor::all()->count();

        //dd($appointment);
        return view('home', compact(['appointmentsToday', 'appointments', 'patients', 'doctors']));
    }
}
