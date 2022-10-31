<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Patient Appointment History</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
        }
        h1{
            text-align:center;
        }
        h2{
            font-size:medium;
            text-align:center;
        }
        body{
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            margin:0;
            padding:0;
            text-align:center;
        }
        p{
            font-size: medium;
        }
        table{
            width: 100%;
            text-align: center;
        }
        td{
            border-collapse: collapse;
            color:black;
        }
        th{
            color:white;
        }
        .logo{
            float:center;
            text-align: center;
            display:block;
            margin: 0 auto;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            position:relative;
        }
        .topnav {
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            text-align: left;
        }
        form .user-details{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 5px 12px 5px;
        }
        form .user-details .input-box{
            margin-bottom: 10px;
            width: 50%;
            padding-left: 25px;
            padding-right: 25px;
        }
        form .input-box span.details{
            display: block;
            font-weight: 500;
            margin-bottom: 5px;

        }
        .user-details .input-box input{
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }
        .user-details .input-box input:focus,
        .user-details .input-box input:valid,
        .user-details .input-box select:valid{
            border-color: forestgreen;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="{{ url('patientappointment/'.Auth::user()->id) }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
</div>
<img src="/img/logo.png" width="180" height="180" class="logo">

<br><br>

<div class="container-fluid">
    <h1>Good day, <b>{{ Auth::user()->name }}</b>!</h1>
    <h2><i>Below is the complete history of your appointments</i></h2>

    <br>
    @if(session()->get('Completed'))
        <div class="alert alert-success">
            {{ session()->get('Completed') }}
        </div><br />
    @endif
    @if(session()->get('Error'))
        <div class="alert alert-danger">
            {{ session()->get('Error') }}
        </div><br />
    @endif
    <table class="table">
        <thead>
        <tr style="background-color:#18A0FB;">
            <th>Appointment ID</th>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Appointment Date</th>
            <th>Appointment Status</th>
        </tr>
        @foreach($list as $app)
            <tr style="background-color:whitesmoke">
                <td>{{ $app->appointment_id }}</td>
                <td>{{ $app->name }}</td>
                <td>{{ $app->specialization }}</td>
                <td>{{ $app->email }}</td>
                <td>{{ $app->contactNumber }}</td>
                <td>{{ $app->date }}</td>
                <td>{{ $app->status }}</td>
            </tr>
        @endforeach
        </thead>
    </table>
    <br>
</div>
</body>
</html>
