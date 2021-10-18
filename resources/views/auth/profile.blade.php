@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary font-weight-bold border-bottom-0 text-white">{{ __('Profile') }}</div>
                <div class="card-body">
                    Name: {{ $user->name }} <br>
                    Email: {{ $user->email }} <br>
                    <a class="btn btn-primary mt-2" href="/profile/change-password">Change password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
