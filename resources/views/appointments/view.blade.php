@extends('layouts.app')

@section('content')
<a class="btn btn-primary mb-3" href="{{route('appointments')}}"><i class="bi bi-arrow-left"></i> Back</a>

<h4>Appointment details</h4>
<hr>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Date</label><br>
        <span class="fw-bold">{{ date('d.m.Y', strtotime($appointment->appointment))}} at {{ date('H:i', strtotime($appointment->appointment))}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Doctor</label><br>
        <span class="fw-bold"><a href="/doctor/view/{{$doctor->id}}">{{$doctor->name}}</a></span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Patient</label><br>
        <span class="fw-bold"><a href="/patient/view/{{$patient->id}}">{{$patient->name}}</a></span>
    </div>
</div>
@endsection