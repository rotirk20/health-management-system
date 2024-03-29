@extends('layouts.app')
@section('title', 'Users')
@section('content')
<a class="btn btn-primary mb-2" href="/settings/users/create">Create user</a>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <th>{{ $loop->index+1 }}</th>
        <td>{{ $user->name }} </td>
        <td>{{ $user->email }} </td>
        @if($user->roles->count() > 0)
        @foreach ($user->roles as $role)
        <td><span class="badge bg-primary p-2">{{ strtolower($role->name) }}</span> </td>
        @endforeach
        @else
        <td>No role</td>
        @endif
        <td><a class="btn btn-primary btn-sm" href="/settings/users/{{$user->id}}/edit">Edit</a>
          <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete item?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a type="button" href='{{ url("user/$user->id/delete") }}' class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection