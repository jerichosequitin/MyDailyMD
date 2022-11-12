<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Create Patient Profile</title>
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
            background-image: url("./img/white-background.png");
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
                    {{Auth::user()->name}}
                </b>
            </h3>
        </div>

        <br>

        <a href="/patientprofile/{{Auth::user()->id}}">Profile</a>
        <br>
        <a href="{{ url('patientmedicalhistory/') }}">Medical History</a>
        <br>
        <a href="{{ url('patientmedication/') }}">Medications</a>
        <br>
        <a href="{{ url('patientallergy/') }}">Allergies</a>
        <br>
        <a href="{{ url('patientprogressnote/') }}">Progress Notes</a>
        <br>
        <a href="{{ url('patientimmunization/') }}">Immunization</a>
        <br><br>
        <a href="{{ url('dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Main Dashboard</a>
    </div>

    <div class="main">
        <h1>
            <b>Create Patient Profile</b>
        </h1>
        <div class="row">
            <div class="content">
                @if(session()->get('Error'))
                    <div class="alert alert-danger">
                        {{ session()->get('Error') }}
                    </div><br />
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/patientprofile/{{ $user->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="column">
                        <div class="container">
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Full Name</span>
                                    <input type="text" class="form-control" value="{{$user->name}}" name="name" disabled>
                                </div>
                                <div class="input-box">
                                    <span class="details">Email Address</span>
                                    <input type="text" value="{{$user->email}}" class="form-control" name="emailAddress" disabled>
                                </div>
                                <div class="input-box">
                                    <span class="details">Date of Birth</span>
                                    <input type="date" value="{{$user->patient_profile->birthdate}}" class="form-control" name="birthdate" required>
                                </div>
                                <div class="input-box">
                                    <span class="details">Sex</span>
                                    <select name="sex" value="{{$user->patient_profile->sex}}" class="form-control"}} required>
                                        <option selected disabled hidden>{{$user->patient_profile->sex }}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="column">
                        <div class="container">
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Address</span>
                                    <input type="text" value="{{$user->patient_profile->address }}" class="form-control" placeholder="Unit #, Street Name, Barangay" name="address" required>
                                </div>
                                <div class="input-box">
                                    <span class="details">City</span>
                                    <input type="text" value="{{$user->patient_profile->city }}" class="form-control" name="city" required>
                                </div>
                                <div class="input-box">
                                    <span class="details">Postal Code</span>
                                    <input type="number" value="{{$user->patient_profile->postalCode }}"
                                           min="0"
                                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                           maxlength = "4"
                                           title="Format: XXXX" class="form-control" placeholder="XXXX" name="postalCode">
                                </div>
                                <div class="input-box">
                                    <span class="details">Marital Status</span>
                                    <select name="maritalStatus" value="{{$user->patient_profile->maritalStatus }}" class="form-control" required>
                                        <option selected disabled hidden>{{$user->patient_profile->maritalStatus }}</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                @if($user->patient_profile->mobileNumber == '')
                                    <div class="input-box">
                                        <span class="details">Mobile Number
                                            <i class="fa fa-exclamation-circle" style="color: red" aria-hidden="true" title="MyDailyMD uses the Philippine Mobile Number format (+63) 9XXXXXXXX."></i>
                                        </span>
                                        <input type="text"
                                               placeholder="9XXXXXXXXX"
                                               maxlength = "10"
                                               title="Format: 9XXXXXXXXX" class="form-control" name="mobileNumber" required>
                                    </div>
                                @else
                                    <div class="input-box">
                                        <span class="details">Mobile Number
                                            <i class="fa fa-exclamation-circle" style="color: red" aria-hidden="true" title="MyDailyMD uses the Philippine Mobile Number format (+63) 9XXXXXXXX."></i>
                                        </span>
                                        <input type="text" value="{{$user->patient_profile->mobileNumber }}"
                                               placeholder="9XXXXXXXXX"
                                               maxlength = "10"
                                               title="Format: 9XXXXXXXXX" class="form-control" name="mobileNumber" required>
                                    </div>
                                @endif
                                <div class="input-box">
                                    <span class="details">Landline Number</span>
                                    <input type="text" value="{{$user->patient_profile->landlineNumber }}"
                                           maxlength = "8"
                                           title="Format: XXXXXXXX" class="form-control" placeholder="XXXXXXXX" name="landlineNumber">
                                </div>
                                <div class="input-box">
                                    <span class="details">Emergency Contact</span>
                                    <input type="text" value="{{$user->patient_profile->emergencyContact }}" class="form-control" name="emergencyContact" required>
                                </div>
                                @if($user->patient_profile->emergencyContactNumber == '')
                                    <div class="input-box">
                                        <span class="details">Emergency Contact Number
                                            <i class="fa fa-exclamation-circle" style="color: red" aria-hidden="true" title="MyDailyMD uses the Philippine Mobile Number format (+63) 9XXXXXXXX."></i>
                                        </span>
                                        <input type="text"
                                               placeholder="9XXXXXXXXX"
                                               maxlength = "10"
                                               title="Format: 9XXXXXXXXX" class="form-control" name="emergencyContactNumber" required>
                                    </div>
                                @else
                                    <div class="input-box">
                                        <span class="details">Emergency Contact Number
                                            <i class="fa fa-exclamation-circle" style="color: red" aria-hidden="true" title="MyDailyMD uses the Philippine Mobile Number format (+63) 9XXXXXXXX."></i>
                                        </span>
                                        <input type="text" value="{{$user->patient_profile->emergencyContactNumber }}"
                                               placeholder="9XXXXXXXXX"
                                               maxlength = "10"
                                               title="Format: 9XXXXXXXXX" class="form-control" name="emergencyContactNumber" required>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-primary">Create Profile</button>
                </form>
            </div>
        </div>
        <br>
    </div>
</div>
</body>
</html>
