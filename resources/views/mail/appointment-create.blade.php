<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Appointment No.{{ $appointment->id }} with {{$doctor->name}}</title>
        <style type="text/css">
            html {
                margin: 0;
            }
            body {
                background-color: #FFFFFF;
                font-size: 14px;
                margin: 36pt;
            }
        </style>
    </head>
    <body>
        <p class="mt-5">Info:</p>
        <table class="table table-bordered">
            <tbody>
                    <tr>
                        <td>Date: {{ $appointment->appointment }}</td>
                    </tr>
                    <tr>
                        <td>Patient: {{ $patient->name }}</td>
                    </tr>
                    <tr>
                        <td>Patient email: {{ $patient->email }}</td>
                    </tr>
                    <tr>
                        <td>Patient phone: {{ $patient->phone }}</td>
                    </tr>
                    <tr>
                        <td>Appontment code with wich you can check: {{ $code }}</td>
                    </tr>
            </tbody>
        </table>
    </body>
</html>