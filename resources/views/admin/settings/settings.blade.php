@extends('layouts.app')
@section('title', 'Settings')
@section('content')
<div class="d-flex flex-wrap flex-sm-row overflow-auto">
    <div class="col-md-3 py-3">
        <div class="bg-white h-100 sticky-top shadow-sm">
            <div class="card-header font-weight-bold px-3 bg-primary text-white">Settings</div>
            <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                <li><a class="dropdown-item py-2 px-3 {{ Route::is('settings') ? 'active' : '' }}" href="{{ route('settings') }}">General settings</a></li>
                <li><a class="dropdown-item py-2 px-3 {{ Route::is('roles') ? 'active' : '' }}" href="{{ route('roles') }}">Roles</a></li>
                <li><a class="dropdown-item py-2 px-3 {{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 py-3">
        <h5>Settings for the whole web app. Here you can setup working hours, name of the web app and other things.</h5>
        <div class="alert-note">
            <i class="bi bi-info-circle"></i> Be aware that you might broke the web app, change permission, restrict user, remove user and roles.
            Changing working hours might affect appointments in which you can't see all appointments on calendar.
        </div>
        <hr>
        <form method="POST" action="/settings">
            @csrf
            <div class="row pb-2">
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Web title:</label>
                    <input type="text" class="form-control" id="title" name="web_title" placeholder="Title" value="{{$settings->web_title}}">
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-2">
                    <label for="start" class="form-label">Working from:</label>
                    <input type="text" class="form-control" name="start_time" id="start" placeholder="Ex. 08:00" value="{{$settings->start_time}}">
                </div>
                <div class="col-md-2">
                    <label for="end" class="form-label">Working till:</label>
                    <input type="text" class="form-control" name="end_time" id="end" placeholder="Ex. 17:00" value="{{$settings->end_time}}">
                </div>
                <div class="col-md-3">
                    <label for="time_interval" class="form-label">Time interval:</label>
                    <select id="time_interval" class="form-select" name="interval" value="{{$settings->interval}}">
                        <option>Choose...</option>
                        <option value="15 mins" @if($settings->interval == 15) selected @endif>15 minutes</option>
                        <option value="30 mins" @if($settings->interval == 30) selected @endif>30 minutes</option>
                        <option value="60 mins" @if($settings->interval == 60) selected @endif>60 minutes</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="time_interval" class="form-label">Time format:</label>
                    <select id="time_interval" class="form-select" name="format" value="{{$settings->format}}">
                        <option>Choose...</option>
                        <option value="12" @if($settings->format == 12) selected @endif>12 hour</option>
                        <option value="24" @if($settings->format == 24) selected @endif>24 hour</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection