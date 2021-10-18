@extends('layouts.app')
@section('title', 'Home')
@section('home-cover')
<div class="cover-image d-flex flex-wrap align-items-center">
    <div class="search-appointment-section rounded col-md-5 shadow">
        <h4 class="text-center">Enter your code to get appointment details</h4>
        <div class="d-flex flex-wrap">
            <form action="{{ route('search') }}" method="GET" class="w-100 search-appointment">
                <div class="text-center d-flex flex-wrap justify-content-center align-items-baseline">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <input type="text" name="code" class="form-control" required placeholder="Ex. A5K31GH" />
                        <small id="codeHelp" class="form-text text-muted text-left" data-toggle="tooltip" data-placement="bottom" title="Your CODE is being sent to email">Where do I get the code?</small>
                    </div>
                    <button type="submit" class="btn btn-primary mt-1">Check appointment</button>
                </div>
            </form>
            @if($appointments != null)
            <div class="appointment-list col-md-6 mx-auto mt-3">
                <p>Date and time: {{ $appointments->appointment->format('d.m.Y H:i') }}</p>
                Patient: {{$patient->name}} <br>
                Doctor: {{$doctor->name}}
            </div>
            @elseif($search != null)
            <div class="no-result col-md-6 mx-auto mt-4">
                <h6>No appointment found.Please check your code.</h6>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection