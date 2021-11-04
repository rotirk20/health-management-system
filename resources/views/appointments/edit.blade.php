@extends('layouts.app')
@section('title', $appointment->appointment)
@section('content')
<a class="btn btn-primary mb-3" href="{{url()->previous()}}"><i class="bi bi-arrow-left"></i> Back</a>
<h4>Edit appointment</h4>
<hr>
{!! Form::model($appointment, [
'method' => 'PUT',
'url' => ['appointment/update', $appointment->id],
'class' => 'row g-3',
'id' => 'searchForm',
'files' =>true,
'enctype'=>'multipart/form-data'
]) !!}
<?php echo Form::token(); ?>
<div class="col-md-6">
    <div style="overflow:hidden;" class="shadow bg-white rounded p-3">
        {{ \Carbon\Carbon::parse($date)->format('d.m.Y') }} at {{$timeHours}}
        <div id="loader">
            <div class="spinner-grow spinner-grow-sm m-auto" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
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
    {{ Form::label('description', 'Description') }}
    {!! Form::textarea('description', $appointment->description, ['class' => 'form-control', 'placeholder' => 'Please Select', 'rows' => '5']) !!}
</div>
<div class="p-3">
    <label>Upload documents</label>
    <input type="file" name="files[]" class="form-control mt-0 files" multiple="">
    <label>Documents</label>
    <div class="documents gallery d-flex flex-wrap">
        @foreach ($files as $file)
        @foreach ($file as $image)
        <a href="{{ asset('storage/images/'.$image->name) }}" class="flex-1">
            <img src="{{ asset('storage/images/'.$image->name) }}" class="img-fluid">
        </a>
        @endforeach
        @endforeach
    </div>
    <!--{!! Form::file('files', $files, ['class' => 'form-control', 'placeholder' => 'Please Select']) !!}-->
</div>

<div class="col-12">
    {{Form::submit('Update Appointment', array('class' => 'btn btn-success'))}}
</div>
{!! Form::close() !!}
@endsection

@section('additional_scripts')
<script>
    $(document).ready(function() {
        $('.gallery').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                zoom: {
                    enabled: true, // By default it's false, so don't forget to enable it
                    duration: 300, // duration of the effect, in milliseconds
                    easing: 'ease-in-out', // CSS transition easing function
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                },
                gallery: {
                    enabled: true
                }
            });
        });
        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: true,
            date: '<?php echo $date ?>',
            minuteStep: 5,
            formatViewType: 'time',
            format: 'L',
            daysOfWeekDisabled: [0, 6]
        });
        $(".time span").filter(function() {
            return $(this).text() == '<?php echo $timeHours ?>';
        }).addClass('active-time');
        var selectedTime;
        var fullDate;
        var date;
        selectedTime = ' <?php echo $timeHours ?>';
        date = $('#datetimepicker12').datetimepicker('viewDate');
        date = moment(date).format('YYYY-M-D');
        $('#time').val(date + ' ' + selectedTime);
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
            selectedTime = '';
            $('#time').val(fullDate);
        });
    });
</script>
@endsection