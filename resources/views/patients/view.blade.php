@extends('layouts.app')
@section('title', $patient->name)
@section('content')
<a class="btn btn-primary mb-3" href="{{route('patients')}}"><i class="bi bi-arrow-left"></i> Back</a>

<h4>{{$patient->name}} details</h4>
<hr>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Email</label><br>
        <span class="fw-bold">{{$patient->email}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label><br>
        <span class="fw-bold">{{$patient->phone}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Age</label><br>
        <span class="fw-bold">{{$patient->age}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Address</label><br>
        <span class="fw-bold">{{$patient->city}}, {{$patient->address}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Upcoming appointments:</label><br>
        <table class="table table-bordered">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Doctor</th>
                <th scope="col">Action</th>
            </thead>
            <tbody>
                @foreach ($app as $appoint)
                @if($appoint->count())
                @if (!empty($doctor->doctors))
                <tr>
                    <th>{{ $loop->index+1 }}</th>
                    <td>
                        <span class="fw-bold"> {{ date('d.m.Y', strtotime($appoint->appointment))}}</span>
                    </td>
                    <td>
                        @foreach($doctor->doctors as $doc)
                        {{ $doc->name }}
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/appointment/view/{{ $appoint->id}}"><i class="bi bi-arrow-right"></i></a>
                    </td>
                </tr>
                @else
                <tr>
                    <td>No appointments.</td>
                </tr>
                @endif
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection