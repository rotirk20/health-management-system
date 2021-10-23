@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <a class="btn btn-primary pull-right mb-3" href="{{ route ('roles') }}"> Back</a>
        <h4>Create role</h4>
        <hr>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{ route('roles.store') }}">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <div class="d-flex flex-wrap">
                    @foreach($permissions->chunk(4) as $permission)
                    <div class="col-md-4 p-0">
                        @foreach($permission as $perm)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="{{ $perm->name }}" value="{{ $perm->id }}" name="permissions[]">
                            <label class="form-check-label" for="{{ $perm->name }}">{{ $perm->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection