@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <a class="btn btn-primary pull-right mb-3" href="/settings/users"> Back</a>
        <h4>Create user</h4>
        <hr>
    </div>
</div>

<form method="post" action="/users/create">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select class="custom-select mb-3" name="roles[]">
                    <option selected>Select Role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}"> {{ $role->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection