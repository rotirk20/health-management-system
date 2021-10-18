@extends('layouts.app')
@section('title', 'Patients')
@section('content')
<a class="btn btn-primary mb-2" href="{{ Route('patient/create')}}">Add Patient</a>
<div class="table-responsive">
  <table class="table responsive nowrap">
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
      @foreach($patients as $pat)
      <tr>
        <th>{{ $loop->index+1 }}</th>
        <td><a href="patient/view/{{$pat->id}}">{{ $pat->name }}</a></td>
        <td>{{ $pat->city }}, {{ $pat->address }} </td>
        <td>{{ $pat->phone }} </td>
        <td><a href="patient/{{$pat->id}}/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
          <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash"></i></button>
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
          @if($patients->count())
          <a type="button" href='{{ url("patient/$pat->id/delete") }}' class="btn btn-danger">Delete</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection