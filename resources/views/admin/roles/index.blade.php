@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="d-flex flex-wrap flex-sm-row overflow-auto">
    <div class="col-md-3 py-1 px-0">
        <div class="bg-white h-100 sticky-top shadow-sm">
            <div class="card-header font-weight-bold px-3 bg-primary text-white">Settings</div>
            <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                <li><a class="dropdown-item py-2 px-3 {{ Route::is('settings') ? 'active' : '' }}" href="{{ route('settings') }}">General settings</a></li>
                <li><a class="dropdown-item py-2 px-3 {{ Route::is('roles') ? 'active' : '' }}" href="{{ route('roles') }}">Roles</a></li>
                <li><a class="dropdown-item py-2 px-3 {{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
    <div class="row">
    <div class="col-lg-12">
        <div>
            @can('role-create')
            <a class="btn btn-primary mb-2" href="{{ route('roles.create') }}">Create Role</a>
            @endcan
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                            @role('Admin')
                            {!! Form::open(['method' => 'GET','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                            @endrole
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.show', $role->id) }}"><i class="bi bi-arrow-right"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
</div>

@endsection