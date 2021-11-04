<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::all();
        return view('doctors.index', ['doctors' => $doctors]);
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'email' => 'required',
            'address' => 'required',
            'age' => 'required'
        ]);
    
        $doctor = new Doctor();
        //On left field name in DB and on right field name in Form/view
        $doctor->name = $request->input('name');
        $doctor->city = $request->input('city');
        $doctor->email = $request->input('email');
        $doctor->phone = $request->input('phone');
        $doctor->title = '';
        $doctor->address = $request->input('address');
        $doctor->save();
        return redirect('doctors')->with('success', 'Doctor created successfully.');
    }
}
