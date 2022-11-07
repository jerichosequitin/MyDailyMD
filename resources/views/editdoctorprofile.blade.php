<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Edit Doctor Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            text-align: center;
        }
        p{
            text-align: center;
            font-size: medium;

        }
        .logo{
            text-align: center;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
        }

        /* Style inputs with type="text", select elements and textareas */
        input[type=text], input[type=number], input[type=time], select, textarea {
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
            width: 90%;
            background-color:#DEF1FD;
            border:1px solid black;
            justify-content: space-between;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        select[name="sex"], select[name="specialization"], select[name="licenseType"]{
            width:100%;
            display: block;
            margin-bottom: 5px;
            height: 45px;
        }
        .topnav
        {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a href="{{ url('doctorprofile/'.Auth::user()->id) }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
    </div>
    <img src="/img/logo.png" width="180" height="180" class="logo">
    <div style="width: 100%">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/doctorprofile/{{ $user->id }}" method="post">
            @csrf
            @method('PATCH')
            <div style="width: 50%; float: left;">
                <br>
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
                            <input type="date" value="{{$user->doctor_profile->birthdate }}" class="form-control" name="birthdate" disabled>
                        </div>
                        <div class="input-box">
                            <span class="details">Sex</span>
                            <select name="sex" value="{{$user->doctor_profile->sex}}" class="form-control"}} disabled>
                                <option selected disabled hidden>{{$user->doctor_profile->sex }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <span class="details">Contact Number</span>
                            <input type="number" value="{{$user->doctor_profile->contactNumber }}"
                                   min="0"
                                   placeholder="09XXXXXXXXX"
                                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                   maxlength = "11"
                                   class="form-control" name="contactNumber" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Specialization</span>
                            <select name="specialization" value="{{$user->doctor_profile->specialization}}" class="form-control"}} disabled>
                                <option selected disabled hidden>{{$user->doctor_profile->specialization }}</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Pathology">Pathology</option>
                                <option value="Pediatrics">Pediatrics</option>
                                <option value="Psychiatry">Psychiatry</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <span class="details">Working Hours</span>
                            <input type="time" value="{{$user->doctor_profile->workingHoursStart }}" step="3600" class="form-control" name="workingHoursStart" required>
                            <span class="details">to</span>
                            <input type="time" value="{{$user->doctor_profile->workingHoursEnd }}" step="3600" class="form-control" name="workingHoursEnd" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Digital Signature</span>
                            <img src="{{$user->doctor_profile->digitalSignature }}" width="100" height="50">
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div style="margin-left: 50%;">
                <div class="container">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Clinic Name</span>
                            <input type="text" value="{{$user->doctor_profile->clinicName }}" class="form-control" name="clinicName" disabled>
                        </div>
                        <div class="input-box">
                            <span class="details">Clinic Address</span>
                            <input type="text" value="{{$user->doctor_profile->clinicAddress }}" class="form-control" name="clinicAddress" disabled>
                        </div>
                        <div class="input-box">
                            <span class="details">Clinic Mobile Number</span>
                            <input type="number" value="{{$user->doctor_profile->clinicMobileNumber }}"
                                   min="0"
                                   placeholder="09XXXXXXXXX"
                                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                   maxlength = "11"
                                   title="Format: 09XXXXXXXXX" class="form-control" placeholder="09XXXXXXXXX" name="clinicMobileNumber">
                        </div>
                        <div class="input-box">
                            <span class="details">Clinic Telephone Number</span>
                            <input type="number" value="{{$user->doctor_profile->clinicTelephoneNumber }}"
                                   min="0"
                                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                   maxlength = "8"
                                   title="Format: XXXXXXXX" class="form-control" placeholder="XXXXXXXX" name="clinicTelephoneNumber">
                        </div>
                        <div class="input-box">
                            <span class="details">License Type</span>
                            <select name="licenseType" value="{{$user->doctor_profile->licenseType}}" class="form-control"}} disabled>
                                <option selected disabled hidden>(PRC) - Professional Regulation Commission</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <span class="details">PRC Number</span>
                            <input type="number" value="{{$user->doctor_profile->prcNumber }}" title="Format: XXXXXXX" class="form-control" name="prcNumber" disabled>
                        </div>
                        <div class="input-box">
                            <span class="details">License Expiry Date</span>
                            <input type="date" value="{{$user->doctor_profile->licenseExpiryDate }}" class="form-control" name="licenseExpiryDate" disabled>
                        </div>
                        <div class="input-box">
                            <span class="details">PRC ID Image</span>
                            <img src="{{$user->doctor_profile->prcImage }}" width="100" height="50">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button class="btn btn-primary">Save Profile</button>
        </form>
    </div>
</body>
</html>
