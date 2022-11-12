<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - View Allergy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        a{
            text-decoration: none;
        }
        a.back{
            text-align: left;
            display: block;
        }
        .container-fluid{
            background-size: 100% 100%;
            background-attachment: fixed;
            background-image: url("./img/bg03.png");
        }
        .content form .user-details{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
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
            color:black;
        }
        body {
            background-color: white;
            background-size: contain;
            background-position-y: top;
            background-position-x: right;
            background-repeat: round;
            text-align: center;
            font-family: 'Poppins'
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
            background-color: #DEF1FD;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #0184DF;
            display: block;
        }

        .sidenav a:hover {
            color: #359DD9;
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
            width: 100%;
            height: 50%;
            background-color:#DEF1FD;
            border:1px solid black;
        }
    </style>
</head>
<body>
<div class="container-fluid p-5 text-black text-center">
    <br>
    <div class="sidenav">
        <div class="left-half">
            <input type="image" src="/img/logo.png" height="140" width="150"/>
            <br>

            <h3>
                <b>
                    {{$patientProfile->user->name}}
                </b>
            </h3>
        </div>
            <br>

            <a href="{{ url('doctormanagehealthrecords/profile/'.$patientProfile->id) }}">Profile</a>
            <br>
            <a href="{{ url('doctormanagehealthrecords/medicalhistory/'.$patientProfile->id) }}">Medical History</a>
            <br>
            <a href="{{ url('doctormanagehealthrecords/medication/'.$patientProfile->id) }}">Medications</a>
            <br>
            <a href="{{ url('doctormanagehealthrecords/allergy/'.$patientProfile->id) }}">Allergies</a>
            <br>
            <a href="{{ url('doctormanagehealthrecords/progressnote/'.$patientProfile->id) }}">Progress Notes</a>
            <br>
            <a href="{{ url('doctormanagehealthrecords/immunization/'.$patientProfile->id) }}">Immunization</a>
            <br><br>
            <a href="{{ url('doctormanagehealthrecords') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Main Dashboard</a>
        </div>

        <div class="main">
            <h1>
                <b>View Allergy</b>
            </h1>
            <div class="row">
                <div class="content">
                    <div class="column">
                        <form>
                            <div class="container">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">Type</span>
                                        <input type="text" class="form-control" name="type" value="{{$allergy->type}} Allergy" required disabled>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Trigger</span>
                                        <input type="text" class="form-control" name="trigger" value="{{$allergy->trigger}}" required disabled>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Reaction</span>
                                        <input type="text" class="form-control" name="reaction" value="{{$allergy->reaction}}" required disabled>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Treatment</span>
                                        <input type="text" class="form-control" name="treatment" value="{{$allergy->treatment}}" required disabled>
                                    </div>
                                    @if($allergy->modifiedBy == '')
                                        <div class="input-box">
                                            <span class="details">Created By</span>
                                            <input type="text" value="Dr. {{$allergy->createdBy}} - {{ date('F j, Y', strtotime($allergy->created_at)) }}" class="form-control" name="createdBy" required disabled>
                                        </div>
                                    @else
                                        <div class="input-box">
                                            <span class="details">Last Modified By</span>
                                            <input type="text" value="Dr. {{$allergy->modifiedBy}} - {{ date('F j, Y', strtotime($allergy->updated_at)) }}" class="form-control" name="modifiedBy" required disabled>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <br>
                        <a href="{{ url('doctormanagehealthrecords/allergy/'.$patientProfile->id) }}" class="btn btn-primary">Back</a>
                        <a href="#edit{{$allergy->id}}" data-bs-toggle="modal" class="btn btn-danger"> Delete</a>
                        @include('doctormanagehealthrecords.allergy_archived')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
