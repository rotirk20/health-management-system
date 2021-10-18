@extends('layouts.app')

@section('content')
<a class="btn btn-primary mb-3" href="{{route('doctor')}}"><i class="bi bi-arrow-left"></i> Back</a>

<h4>{{$doctor->name}} details</h4>
<hr>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Email</label><br>
        <span class="fw-bold">{{$doctor->email}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label><br>
        <span class="fw-bold">{{$doctor->phone}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Age</label><br>
        <span class="fw-bold">{{$doctor->age}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Address</label><br>
        <span class="fw-bold">{{$doctor->city}}, {{$doctor->address}}</span>
    </div>
    <div class="col-md-6">
        <label class="form-label">Appointments:</label><br>
        <table class="table table-bordered">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Doctor</th>
                <th scope="col">Action</th>
            </thead>
            <tbody>
                @foreach ($patient->appointments as $appointment)
                <tr>
                    <th>{{ $loop->index+1 }}</th>
                    <td>
                        <span class="fw-bold"> {{ date('d.m.Y', strtotime($appointment->pivot->appointment))}}</span>
                    </td>
                    <td>
                        @foreach($doctor->doctors as $doc)
                            {{ $doc->name }}
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/appointment/view/{{$app->id}}"><i class="bi bi-arrow-right"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection