@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h4>{{ __('Dashboard') }}</h4>

        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <!--{{ __('You are logged in!') }}-->
            <div class="row justify-content-between">
                <div class="col-md-3 shadow-sm border-0 bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-center">Appointments total</h5>
                        <h4 class="text-center">{{ $appointments }}</h4>
                        <p class="text-center">Today: {{$appointmentsToday}}</p>
                    </div>
                </div>
                <div class="col-md-3 shadow-sm border-0 bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-center">Patients total</h5>
                        <h4 class="text-center">{{ $patients }}</h4>
                    </div>
                </div>
                <div class="col-md-3 shadow-sm border-0 bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-center">Doctors total</h5>
                        <h4 class="text-center">{{ $doctors }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection