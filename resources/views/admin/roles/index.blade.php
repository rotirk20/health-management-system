@extends('layouts.app')
@section('title', 'Roles')
@section('content')
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
                            <a class="btn btn-primary btn-sm" href="/roles/{{$role->id}}"><i class="bi bi-arrow-right"></i></a>
                            @role('Admin')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                            @endrole
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection