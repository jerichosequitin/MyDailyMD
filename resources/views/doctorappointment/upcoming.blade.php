<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Doctor Upcoming Appointments</title>
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

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="{{ url('doctorappointment/list') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
</div>
<img src="/img/logo.png" width="180" height="180" class="logo">

<br><br>

<div class="container-fluid">
    <h1>Good day, <b>{{ Auth::user()->name }}</b>!</h1>
    <h2><i>Below is the list of your upcoming appointments</i></h2>

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
            <th>Patient Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Gender</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Appointment Status</th>
            <th>Meeting Link</th>
            <th></th>
        </tr>
        @if(count($list) > 0)
            @foreach($list as $app)
                <tr style="background-color:whitesmoke">
                    <td>{{ $app->name }}</td>
                    <td>{{ $app->email }}</td>
                    <td>{{ $app->mobileNumber }}</td>
                    <td>{{ $app->sex }}</td>
                    <td>{{ date('F j, Y', strtotime($app->date)) }}</td>
                    <td>{{ date('h:i A', strtotime($app->start)) }} to {{ date('h:i A', strtotime($app->end)) }}</td>
                    <td>{{ $app->status }}</td>
                    <td>{{ $app->meetingLink }}</td>
                    <td><a href="{{ route('patientappointment.edit', $app->appointment_id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                </tr>
            @endforeach
        @else
            <tr style="background-color:whitesmoke">
                <td colspan="8" class="text-center">You have no upcoming appointments.</td>
            </tr>
        @endif
        </thead>
    </table>
    {{$list->links()}}
    <br>
</div>
</body>
</html>
