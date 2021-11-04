@extends('layouts.app')
@section('title', 'Verify appointment')
@section('content')
<div class="col-md-4 mx-auto">
    <h4 class="text-align">Verify appointment with your code</h4>
    <form action="/appointments/verify" method="POST">
    @csrf
        <input class="form-control mt-4 col-md-5 mx-auto" type="text" name="code" placeholder="Code" value="{{$code}}">
        <button class="btn btn-primary mx-auto text-center d-block mt-2">Confirm</button>
    </form>
</div>

@endsection