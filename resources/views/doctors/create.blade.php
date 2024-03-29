@extends('layouts.app')
@section('title', 'Create doctor')
@section('content')
<a class="btn btn-primary mb-3" href="{{route('doctors')}}">Back</a>
<h4>Create doctor</h4>
<hr>
{{ Form::open(array('route' => 'doctor/create', 'class' => 'row g-3')) }}
<?php echo Form::token(); ?>
<div class="col-md-6">
    <?php echo Form::label('name', 'Name'); ?>
    {{Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Fullname'))}}
</div>
<div class="col-md-4">
    <?php echo Form::label('email', 'Email'); ?>
    {{Form::email('email',null, array('class' => 'form-control', 'placeholder' => 'example@email.com'))}}
</div>
<div class="col-md-2">
    <?php echo Form::label('age', 'Age'); ?>
    {{Form::number('age',null, array('class' => 'form-control', 'placeholder' => 'Age'))}}
</div>
<div class="col-md-6">
    <?php echo Form::label('city', 'City'); ?>
    {{Form::text('city',null, array('class' => 'form-control', 'placeholder' => 'City'))}}
</div>
<div class="col-md-6">
    <?php echo Form::label('address', 'Address'); ?>
    {{Form::text('address',null, array('class' => 'form-control', 'placeholder' => 'Address'))}}
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
    {{Form::submit('Add Doctor', array('class' => 'btn btn-success'))}}
</div>
{{ Form::close() }}
@endsection