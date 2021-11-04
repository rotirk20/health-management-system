@extends('layouts.app')
@section('title', 'Settings')
@section('content')
<div class="d-flex flex-wrap flex-sm-row overflow-auto">
    <div class="col-md-3 py-3">
        <div class="bg-white sticky-top shadow-sm">
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
        <form method="POST" action="/settings" enctype="multipart/form-data">
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
                    <input type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" id="start" placeholder="Ex. 08:00" value="{{$settings->start_time}}">
                </div>
                <div class="col-md-2">
                    <label for="end" class="form-label">Working till:</label>
                    <input type="text" class="form-control @error('end_time') is-invalid @enderror" name="end_time" id="end" placeholder="Ex. 17:00" value="{{$settings->end_time}}">
                </div>
                <div class="col-md-3">
                    <label for="time_interval" class="form-label">Time interval:</label>
                    <select id="time_interval" class="form-select @error('interval') is-invalid @enderror" name="interval" value="{{$settings->interval}}">
                        <option disabled>Choose...</option>
                        <option value="15 mins" @if($settings->interval == 15) selected @endif>15 minutes</option>
                        <option value="30 mins" @if($settings->interval == 30) selected @endif>30 minutes</option>
                        <option value="60 mins" @if($settings->interval == 60) selected @endif>60 minutes</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="format" class="form-label">Time format:</label>
                    <select id="format" class="form-select" name="format" value="{{$settings->format}}">
                        <option disabled>Choose...</option>
                        <option value="12" @if($settings->format == 12) selected @endif>12 hour</option>
                        <option value="24" @if($settings->format == 24) selected @endif>24 hour</option>
                    </select>
                </div>
                <div class="w-100"></div>
                <div class="col-md-2">
                    <label for="pause_time" class="form-label">Pause:</label>
                    <select id="pause_time" class="form-select" name="pause_time" value="{{$settings->pause_time}}">
                        <option disabled>Choose...</option>
                        @foreach ($times as $time)
                        <option value="{{$time}}" @if($settings->pause_time == $time) selected @endif>{{$time}}</option>
                        @endforeach
                    </select>
                </div>
                <h5 class="mt-3">Color theming</h5>
                <div class="col-md-3">
                    <label for="time_interval" class="form-label">Primary</label>
                    <div class="input-group" title="Using format option">
                        <input type="text" class="form-control input-lg" name="primary_color" value="{{$settings->primary_color}}" id="primary" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="time_interval" class="form-label">Secondary</label>
                    <div class="input-group" title="Using format option">
                        <input type="text" class="form-control input-lg" name="secondary_color" value="{{$settings->secondary_color}}" id="secondary" />
                    </div>
                </div>

                <h5 class="mt-3">Logo</h5>
                <div class="col-md-5">
                    <div class="input-group" title="Using format option">
                        <input type="file" class="form-control input-lg" name="logo_path" id="photo" />
                        <a class="btn btn-danger remove_image shadow-sm"><i class="bi bi-x-circle"></i></a>
                        @if($settings->logo_path != null)
                        <div id="imageDiv">
                            <img id="imgPreview" src="{{ asset('storage/images/logo/'.$settings->logo_path) }}" alt="{{$settings->logo_path}}" />
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Save</button>
            @if ($errors->any())
            <div class="alert alert-danger mt-2">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
        </form>
    </div>
</div>
@endsection
@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
</script>
<script>
    $('#primary,#secondary').spectrum({
        type: "component",
        togglePaletteOnly: true,
        hideAfterPaletteSelect: true,
        showInput: true,
        showInitial: true
    });
    $(document).ready(() => {
        $('.remove_image').on('click', function() {
            $('#photo').val(null);
            $('#imgPreview').attr('src', '');
            if ($('#photo').val() == '') {
                $("#imageDiv").hide();
                $('.remove_image').hide();
            }
        })
        $('#photo').change(function() {
            const file = this.files[0];
            if (file) {
                $("#imageDiv").show();
                $('.remove_image').show();
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection