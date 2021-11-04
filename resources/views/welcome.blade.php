@extends('layouts.app')
@section('title', 'Home')
@section('home-cover')
<div class="cover-image col-md-12 d-flex flex-wrap align-items-center container">
    <div class="search-appointment-section rounded col-md-3 offset-md-6 shadow my-5">
        <h5>Enter your code to get appointment details</h5>
        <hr class="mt-1">
        <form id="searchForm" action="/create-appointment" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Fullname</label>
                    <input type="text" class="form-control" name="name" placeholder="John Jonhson">
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="example@hotmail.com">
                </div>
            </div>
            <div style="overflow:hidden;">
                <div id="loader">
                    <div class="spinner-grow spinner-grow-sm m-auto" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <input name="appointment" type="text" id="datetimepicker12" hidden>
                <input name="time" type="text" id="time" hidden>
            </div>
            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Select time</a>
            <button class="btn btn-primary mt-2">Create</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Select time</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="time">
                                @foreach($times as $time)
                                <span>{{$time}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('content')
<h4 class="text-center">Check your appointment informations</h4>
<div class="d-flex flex-wrap">
    <div class="col-md-6">
        <div class="search-appointment-section rounded col-md-12 mt-4">
            <h5 class="text-center">Enter your code to get appointment details</h5>
            <div class="d-flex flex-wrap">
                <form action="{{ route('search') }}" method="GET" class="w-100 search-appointment">
                    <div class="text-center d-flex flex-wrap justify-content-center align-items-baseline">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <input type="text" name="code" class="form-control" required placeholder="Ex. A5K31GH" />
                            <small id="codeHelp" class="form-text text-muted text-center" data-toggle="tooltip" data-placement="bottom" title="Your CODE is being sent to email">Where do I get the code?</small>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1">Check appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @if($appointments != null)
        <div class="appointment-list col-md-6 mx-auto mt-4 pt-4">
            <p>Date and time: {{ $appointments->appointment->format('d.m.Y H:i') }}</p>
            Patient: {{$patient->name}} <br>
            Doctor: {{$doctor->name}}
        </div>
        @elseif($search != null)
        <div class="no-result col-md-6 mx-auto mt-4 pt-4">
            <h6>No appointment found.Please check your code.</h6>
        </div>
        @endif
    </div>

</div>
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