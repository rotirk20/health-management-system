@extends('layouts.app')
@section('title', 'Edit role - $role->name')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a class="btn btn-primary pull-right mb-3" href="{{ route('roles') }}"> Back</a>
            <h4>Update role - {{$role->name}} </h4>
            <hr>
        </div>
    </div>

    <form method="post" action="{{ route('roles.update', $role->id) }}">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
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
                                <input class="form-check-input" type="checkbox" id="{{ $perm->name }}" value="{{ $perm->id }}" name="permissions[]" @if(in_array($perm->id, $rolePermissions) ) checked @endif>
                                <label class="form-check-label" for="{{ $perm->name }}">{{ $perm->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

@endsection