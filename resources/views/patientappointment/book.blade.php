<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Set an Appointment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.date').datetimepicker({
                format: 'MM/DD/YYYY',
                locale: 'en'
            });
    </script>
    <!-- Internal CSS -->
    <style>
        a{
            text-decoration: none;
        }
        a.back{
            text-align: left;
            display: block;
        }
        .content form .user-details{
            display:inline;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0 12px 0;
        }
        form .user-details .input-box{
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
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
        .user-details .input-box input:valid{
            border-color: #9b59b6;
        }

        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            align-items: center;
        }
        h1{
            text-align:center;
            font-size:large;
        }
        h2{
            font-size:medium;
            text-align:center;
        }
        h3{
            font-size:20px;
            text-align:center;
            color:#EFFCFF;
        }

        body{
            background-color:#EAFAFF;
            background-size:contain;
            background-position-y: top;
            background-position-x: right;
            background-repeat:round;
            text-align: center;
        }
        p{
            text-align: center;
            font-size: medium;

        }
        .sidenav{
            height: 150%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #0184DF;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #EFFCFF;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }
        .main {
            margin-left: 250px; /* Same as the width of the sidenav */
            font-size: 14px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }

        /* Style inputs with type="text", select elements and textareas */
        input[type=text], select, textarea {
            width: 100%; /* Full width */
            padding: 12px; /* Some padding */
            border: 1px solid #ccc; /* Gray border */
            border-radius: 4px; /* Rounded borders */
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-top: 6px; /* Add a top margin */
            margin-bottom: 16px; /* Bottom margin */
            resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
        }

        /* Style the submit button with a specific background color etc */
        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* When moving the mouse over the submit button, add a darker green color */
        input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Add a background color and some padding around the form */
        .container {
            border-radius: 15px;
            padding: 20px;
            width: 50%;
            height: 15%;
            background-color:#DEF1FD;
            border:1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container-fluid p-5 text-black text-center">
    <br>
    <div class="sidenav">
        <div class="left-half">
            <h3>
                <b>
                    {{Auth::user()->name}}
                </b>
            </h3>
            <br>
            <input type="image" src="/img/patient2.png" height="120" width="150"/>
        </div>

        <br>

        <a href="/patientprofile/{{Auth::user()->id}}">Profile</a>
        <br>
        <a href="{{ url('patientmedicalhistory/') }}">Medical History</a>
        <br>
        <a href="patientmedications">Medications</a>
        <br>
        <a href="patientallergies">Allergies</a>
        <br>
        <a href="patientprogressnotes">Progress Notes</a>
        <br>
        <a href="{{ url('patientimmunization/') }}">Immunization</a>
        <br><br>
        <a href="{{ url('dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a>
    </div>

    <div class="main">
        <h1>
            <b>Book an Appointment</b>
        </h1>
        <div class="content">
            @if(session()->get('Error'))
                <div class="alert alert-danger">
                    {{ session()->get('Error') }}
                </div><br />
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
                <div class="container">
                    <table class="table">
                        <thead>
                        <tr style="background-color:#18A0FB;">
                            <th>Reserved Dates</th>
                        </tr>
                        @foreach($list as $app)
                            <tr style="background-color:whitesmoke">
                                <td>{{ $app->date }}</td>
                            </tr>
                        @endforeach
                        </thead>
                    </table>
                    <center>
                        <form method="post" action="{{ route('patientappointment.store')}}">
                            @csrf
                        <div class="user-details">
                            <input type="text" class="form-control" name="patient_user_id" value="{{Auth::user()->id}}" required readonly hidden>
                            <input type="text" class="form-control" name="patient_id" value="{{Auth::user()->patient_profile->id}}" required readonly hidden>
                            <input type="text" class="form-control" name="patient_email" value="{{Auth::user()->email}}" required readonly hidden>
                            <input type="text" class="form-control" name="doctor_user_id" value="{{$doctorProfile->user_id}}" required readonly hidden>
                            <input type="text" class="form-control" name="doctor_id" value="{{$doctorProfile->id}}" required readonly hidden>

                            <div class="input-box">
                                <span class="details">Doctor Name</span>
                                <input type="text" class="form-control" value="{{$doctorProfile->user->name}}" name="doctorName" disabled>
                            </div>
                            <div class="input-box">
                                <span class="details">Doctor Gender</span>
                                <input type="text" class="form-control" value="{{$doctorProfile->sex}}" name="doctorGender" disabled>
                            </div>
                            <div class="input-box">
                                <span class="details">Doctor Specialization</span>
                                <input type="text" class="form-control" value="{{$doctorProfile->specialization}}" name="doctorSpecialization" disabled>
                            </div>
                            <div class="input-box">
                                <span class="details">Doctor Contact Number</span>
                                <input type="text" class="form-control" value="{{$doctorProfile->contactNumber}}" name="doctorContactNumber" disabled>
                            </div>
                            <div class="input-box">
                                <span class="details">Appointment Date</span>
                                <input type="date" class="form-control" name="date">
                            </div>

                            <input type="text" class="form-control" name="status" value="Pending" hidden>
                        </div>
                        <button class="btn btn-primary">Schedule Appointment</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
