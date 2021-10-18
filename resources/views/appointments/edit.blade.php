@extends('layouts.app')

@section('content')
<a class="btn btn-primary mb-3" href="{{route('appointments')}}"><i class="bi bi-arrow-left"></i> Back</a>
{!! Form::model($appointment, [
'method' => 'PUT',
'url' => ['appointment/update', $appointment->id],
'class' => 'row g-3',
'id' => 'searchForm'
]) !!}
<?php echo Form::token(); ?>
<div class="col-md-6">
    <div style="overflow:hidden;">
        {{ \Carbon\Carbon::parse($date)->format('d.m.Y') }} at {{$timeHours}}
        <input type="text" name="appointment" class="form-control" id="datetimepicker12" hidden>
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
    {!! Form::select('patient_id', $patients, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please Select']) !!}
    {{ Form::label('doctor_id', 'Doctor') }}
    {!! Form::select('doctor_id', $doctors, null, ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please Select']) !!}
</div>
<div class="col-12">
    {{Form::submit('Update Appointment', array('class' => 'btn btn-success'))}}
</div>
{!! Form::close() !!}
@endsection

@section('additional_scripts')
<script>
    $(document).ready(function() {
        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: true,
            date: '<?php echo $date ?>',
            minuteStep: 5,
            formatViewType: 'time',
            format: 'L',
        });
        $(".time span").filter(function() {
            return $(this).text() == '<?php echo $timeHours ?>';
        }).addClass('active-time');
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
            success: function(result) {
                console.log(result)
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