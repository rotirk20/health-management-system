<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointmentsToday = Appointment::whereDate('appointment', '=', date('Y-m-d'))->count();
        $appointments = Appointment::all()->count();
        $patients = Patient::all()->count();
        $doctors = Doctor::all()->count();

        $patientsMonthly = Appointment::get()->groupBy(function ($d) {
            return Carbon::parse($d->created_at)->format('M');
        });
        $months = $patientsMonthly->keys();
        //dd($months);
        //return response()->json($patientsMonthly);
        return view('home', compact(['appointmentsToday', 'appointments', 'patients', 'doctors', 'patientsMonthly', 'months']));
    }


    public function data(Request $request)
    {
        switch ($request->input('data')) {
            case "patientsMonthly":
                $data = Patient::get()->groupBy(function ($d) {
                    return Carbon::parse($d->created_at)->format('M');
                });
                $months = $data->keys();
                $title = "Patients monthly";
                break;
            case "appointmentsMonthly":
                $data = Appointment::get()->groupBy(function ($d) {
                    return Carbon::parse($d->created_at)->format('M');
                });
                $months = $data->keys();
                $title = "Appointments monthly";
                break;
            case "avg":
                $data = collect(Patient::get(['birthdate'])->pluck('birthdate')->toArray());
                $age = $data->map(function ($item, $key) {
                    return Carbon::parse($item)->diff(Carbon::now())->format('%y');
                });
                $avgAge = $age->avg();
                break;
            default:
                $data = Patient::get()->groupBy(function ($d) {
                    return Carbon::parse($d->created_at)->format('M');
                });
                $months = $data->keys();
                $title = "Patients monthly";
        }
        return response()->json([$data, $months, $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
