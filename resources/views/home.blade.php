@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h4 class="card-header bg-primary font-weight-bold border-bottom-0 text-white mb-3">{{ __('Dashboard') }}</h4>
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="d-flex flex-wrap mb-3">
                <div class="col-md-9 d-flex flex-wrap">
                    <a class="btn btn-primary m-2" href="{{ route('appointment/create')}}">Add appointment</a>
                    <a class="btn btn-primary m-2" href="{{ route('patient/create')}}">Add patient</a>
                    <a class="btn btn-primary m-2" href="{{ route('doctor/create')}}">Add doctor</a>
                </div>
                <div class="col-md-3 ml-auto">
                    <form action="/charts-data" id="chartDropdown" method="POST">
                        <select class="form-select m-2" id="dataTypes" name="data[]">
                            <option value="patientsMonthly">Patients monthly</option>
                            <option value="appointmentsMonthly">Appointments monthly</option>
                            <option value="averageAge">Average age</option>
                        </select>
                    </form>
                </div>
            </div>
            <div id="main" style="width:100%;height:400px;">
            </div>
            <div class="row justify-content-between">
                <div class="col-md-3 shadow-sm border-0 bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-center">Appointments total</h5>
                        <h4 class="text-center">{{ $appointments }}</h4>
                        <p class="text-center">Today: {{$appointmentsToday}}</p>
                    </div>
                </div>
                <div class="col-md-3 shadow-sm border-0 bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-center">Patients total</h5>
                        <h4 class="text-center">{{ $patients }}</h4>
                    </div>
                </div>
                <div class="col-md-3 shadow-sm border-0 bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-center">Doctors total</h5>
                        <h4 class="text-center">{{ $doctors }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js" integrity="sha256-EJb5T/UXVVwHY/BJ33bAFqyyzsAqdl4ZCElh3UYvaLk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var chartData;
        var months;
        $('#dataTypes').change(function(e) {
            var data = e.target.value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/charts-data',
                dataType: "json",
                data: {
                    data
                },
                success: function(result) {
                    chartData = result[0];
                    months = result[1];
                    var title = result[2];
                    var dataNumber = [];
                    for (let i = 0; i < months.length; i++) {
                        dataNumber.push(chartData[months[i]].length);
                    }
                    // Initialize the echarts instance based on the prepared dom
                    var myChart = echarts.init(document.getElementById('main'));
                    // Specify the configuration items and data for the chart
                    var option = {
                        title: {
                            text: title
                        },
                        tooltip: {},
                        xAxis: {
                            data: ['Oct', 'Nov']
                        },
                        yAxis: {},
                        series: [{
                            name: title,
                            type: 'line',
                            data: dataNumber,
                            smooth: true
                        }]
                    };

                    // Display the chart using the configuration items and data just specified.
                    myChart.setOption(option);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/charts-data',
                dataType: "json",
                data: {
                    data: 'patientsMonthly'
                },
                success: function(result) {
                    chartData = result[0];
                    months = result[1];
                    var title = result[2];
                    var dataNumber = [];
                    for (let i = 0; i < months.length; i++) {
                        dataNumber.push(chartData[months[i]].length);
                    }
                    // Initialize the echarts instance based on the prepared dom
                    var myChart = echarts.init(document.getElementById('main'));
                    // Specify the configuration items and data for the chart
                    var option = {
                        title: {
                            text: title
                        },
                        tooltip: {},
                        xAxis: {
                            data: ['Oct', 'Nov']
                        },
                        yAxis: {},
                        series: [{
                            name: title,
                            type: 'line',
                            data: dataNumber,
                            smooth: true
                        }]
                    };

                    // Display the chart using the configuration items and data just specified.
                    myChart.setOption(option);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    });
</script>
@endsection