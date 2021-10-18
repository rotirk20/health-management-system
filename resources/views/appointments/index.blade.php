@extends('layouts.app')
@section('content')
@section('title', 'Appointments')
<a class="btn btn-primary mb-0" href="{{ Route('appointment/create')}}">Add Appointment</a>
<form>
  <div class="d-flex flex-wrap m-2 w-50 float-right justify-content-end">
    <div class="input-group mb-3">
      <input class="form-control w-50" placeholder="Search by any column..." id="searchAppointment" name="search">
      <select class="form-select w-25" aria-label="Default select example" name="searchType">
        <option selected>Name</option>
        <option >Code</option>
      </select>
    </div>
  </div>
</form>
<div class="table-responsive">
  <table class="table" id="appointments">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Doctor</th>
        <th scope="col">Patient</th>
        <th scope="col">Code</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($appointments as $appointment)
      <tr>
        <th>{{ $loop->index+1 }}</th>
        <td><a href="appointment/view/{{$appointment->id}}">{{ $appointment->appointment->format('d.m.Y H:i') }}</a></td>
        <td>
          @foreach($appointment->doctors as $doctor)
          {{ $doctor->name }}
          @endforeach
        </td>
        <td>
          @foreach($appointment->patients as $patient)
          {{ $patient->name }}
          @endforeach
        </td>
        <td>
          {{ $appointment->code }}
        </td>
        <td><a class="btn btn-primary btn-sm" href="appointment/{{$appointment->id}}/edit"><i class="bi bi-pencil"></i></a>
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
          @if($appointments->count())
          <a type="button" href='{{ url("appointment/$appointment->id/delete") }}' class="btn btn-danger">Delete</a>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-wrap justify-content-between">
    <div>
      Showing {{ $appointments->firstItem() }} to {{ $appointments->lastItem() }} of total {{$appointments->total()}} entries <br>
      {{ $appointments->links('pagination::bootstrap-4') }}
    </div>
    <div>
      <form method="GET" class="px-1" role="form" action="{{url()->current()}}">
        <div class="form-group">
          <label class="mb-0" for="perPage">Per page</label>
          <select class="form-control" id="perPage">
            <option value="5" @if($perPage==5) selected @endif>5</option>
            <option value="10" @if($perPage==10) selected @endif>10</option>
            <option value="15" @if($perPage==15) selected @endif>15</option>
            <option value="20" @if($perPage==20) selected @endif>20</option>
            <option value="25" @if($perPage==25) selected @endif>25</option>
          </select>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('additional_scripts')
<script>
  document.getElementById('perPage').onchange = function() {
    window.location = "{!! $appointments->url(1) !!}&perPage=" + this.value;
  };
  $(document).ready(function() {

  });
</script>
@endsection