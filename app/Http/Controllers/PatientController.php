<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use JsonResponse;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::with(['appointments'])->get();
        //dd($patients);
        return view('patients.index', ['patients' => $patients]);
    }

    // Controller function that returns data from website via ORM
    public function getPatients()
    {
        return response()->json([
            "patients" => Patient::all()
        ]);
    }

    public function create()
    {
        return view('patients.create');
    }

    public function show($id)
    {
        $date = date('Y-m-d H:i');
        $patient = Patient::with('appointments')->where('id', '=', $id)->first();
        $appointments = $patient->appointments;
        if ($appointments->count() > 0) {
            foreach ($appointments as $appointment) {
                $app = Appointment::with('patients')->where('patient_id', '=', $id)->where('appointment', '>=', $date)->get();
            }
        } else {
            $app = [];
        }
        return view('patients.view', ['patient' => $patient, 'appointments' => $app]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:patients',
            'city' => 'required',
            'birthdate' => 'required'
        ]);

        $patient = new Patient();
        //On left field name in DB and on right field name in Form/view
        $patient->name = $request->input('name');
        $patient->city = $request->input('city');
        $patient->email = $request->input('email');
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
        $patient->birthdate = $request->input('birthdate');
        $patient->save();
        return redirect('patients')->with('success', 'Patient created successfully.');
    }

    public function edit($id)
    {
        $patient = Patient::where('id',  '=', $id)->first();

        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request)
    {
        $patient = Patient::find($request->id);
        $patient->fill($request->all());
        $patient->save();
        return redirect('/patients');
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return redirect('patients');
    }
}
