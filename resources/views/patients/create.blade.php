@extends('layouts.app')
@section('title', 'Create patient')
@section('content')
<a class="btn btn-primary mb-3" href="{{route('patients')}}"><i class="bi bi-arrow-left"></i> Back</a>
<h4>Create patient</h4>
<hr>
{{ Form::open(array('route' => 'patient/create', 'class' => 'row g-3')) }}
<?php echo Form::token(); ?>
<div class="col-md-6">
    <?php echo Form::label('name', 'Name'); ?>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Fullname" value={{ old('name') }}>
</div>
<div class="col-md-3">
    <?php echo Form::label('email', 'Email'); ?>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="example@hotmail.com" value={{ old('email') }}>
</div>
<div class="col-md-3">
    <?php echo Form::label('birthdate', 'Birthdate'); ?>
    <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value={{ old('birthdate') }}>
</div>
<div class="col-md-6">
    <?php echo Form::label('city', 'City'); ?>
    {{Form::text('city',null, array('class' => 'form-control', 'placeholder' => 'City'))}}
</div>
<div class="col-md-6">
    <?php echo Form::label('address', 'Address'); ?>
    {{Form::text('address',null, array('class' => 'form-control', 'placeholder' => '1234 Main St'))}}
</div>
<div class="col-md-6">
    <?php echo Form::label('phone', 'Phone'); ?>
    {{Form::text('phone',null, array('class' => 'form-control', 'placeholder' => 'Phone'))}}
</div>
<div class="col-12">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
            Check me out
        </label>
    </div>
</div>
<div class="col-12">
    {{Form::submit('Add Patient', array('class' => 'btn btn-success'))}}
    @if ($errors->any())
    <div class="alert alert-danger mt-2">
        @foreach ($errors->all() as $error)
        <p class="mb-1">{{ $error }}</p>
        @endforeach
    </div>
    @endif
</div>
{{ Form::close() }}
@endsection