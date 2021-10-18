@extends('layouts.app')
@section('content')
<a class="btn btn-primary mb-2" href="{{ Route('doctor/create')}}">Add Doctor</a>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Location</th>
        <th scope="col">Phone</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($doctors as $doctor)
      <tr>
        <th>{{ $loop->index+1 }}</th>
        <td>{{ $doctor->name }} </td>
        <td>{{ $doctor->city }}</td>
        <td>{{ $doctor->phone }} </td>
        <td><a class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
          <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash"></i></button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection