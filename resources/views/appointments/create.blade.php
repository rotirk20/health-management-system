@extends('layouts.app')
@section('title', 'Create appointment')
@section('content')
<a class="btn btn-primary mb-3" href="{{route('appointments')}}">Back</a>
<h4>Create appointment</h4>
<hr>
{{ Form::open(array('route' => 'appointment/create', 'class' => 'row g-3', 'id' => 'searchForm')) }}
<?php echo Form::token(); ?>
<div class="col-md-6">
    <div style="overflow:hidden;">
        <div id="loader">
            <div class="spinner-grow spinner-grow-sm m-auto" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <input name="appointment" type="text" id="datetimepicker12" hidden>
        <input name="time" type="text" id="time" hidden>
        <div class="time">
            @foreach($times as $time)
            <span>{{$time}}</span>
            @endforeach
        </div>
    </div>
</div>
<div class="col-md-6">
    {{ Form::label('patient_id', 'Patient') }}
    {!! Form::select('patient_id', $patients, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select patient']) !!}
    {{ Form::label('doctor_id', 'Doctor') }}
    {!! Form::select('doctor_id', $doctors, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select doctor']) !!}
    <label>Description</label>
    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
</div>
<div class="col-12">
    {{Form::submit('Add Appointment', array('class' => 'btn btn-success'))}}
</div>
{{ Form::close() }}
@endsection

@section('additional_scripts')
<script>
    $(function() {
        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: true,
            minuteStep: 5,
            formatViewType: 'time',
            format: 'L',
            minDate: new Date(),
            daysOfWeekDisabled: [0, 6]
        });
        var selectedTime;
        var fullDate;
        var date;
        date = $('#datetimepicker12').datetimepicker('viewDate');
        date = moment(date).format('YYYY-M-D');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/date_check',
            dataType: "json",
            data: {
                data: date
            },
            beforeSend: function() {
                $('#loader').show();
            },
            complete: function() {
                $('#loader').hide();
            },
            success: function(result) {
                $('.reserved').removeClass('reserved');
                for (let i = 0; i < result.length; i++) {
                    $(".time span").filter(function() {
                        return $(this).text() === result[i];
                    }).addClass('reserved');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
        $('#datetimepicker12').on('change.datetimepicker', function(event) {
            date = moment(event.date._d).format('YYYY-M-D');
            $('.active-time').removeClass('active-time');
            fullDate = undefined;
            $('#time').val(fullDate);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/date_check',
                dataType: "json",
                data: {
                    data: date
                },
                beforeSend: function() {
                    $('#loader').show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                success: function(result) {
                    $('.reserved').removeClass('reserved');
                    for (let i = 0; i < result.length; i++) {
                        $(".time span").filter(function() {
                            return $(this).text() === result[i];
                        }).addClass('reserved');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
        $('.time span').on('click', function() {
            $('.active-time').removeClass('active-time');
            $(this).addClass('active-time');
            selectedTime = $(this).text();
            fullDate = date + ' ' + selectedTime + ':00';
            selectedTime = "";
            $('#time').val(fullDate);
        });
        $("#searchForm").submit(function(event) {
            if (selectedTime != '') {
                event.preventDefault();
                alert('Select time to create appointment');
            }
        });
    });
</script>
@endsection