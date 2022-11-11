<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Admin Doctor List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-top: 6px; /* Add a top margin */
            margin-bottom: 16px; /* Bottom margin */
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
            font-family: 'Poppins'

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
        /* Style inputs with type="text", select elements and textareas */
        input[type=text], select, textarea {
            width: 50%; /* Full width */
            padding: 12px; /* Some padding */
            border: 1px solid #ccc; /* Gray border */
            border-radius: 4px; /* Rounded borders */
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-top: 6px; /* Add a top margin */
            margin-bottom: 16px; /* Bottom margin */
            resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
        }

        select[name="isVerified"]{
            width:50%;
            display: block;
            margin-bottom: 5px;
            height: 45px;
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
            width: 40%;
            background-color:#DEF1FD;
            border:1px solid black;
        }
        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            align-items: center;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="{{ url('admindoctorlist') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
</div>
<br>
<div class="container-fluid">
    <h1>Verify Doctor Profile</h1>
    <h2><i>Ensure that <b>PRC Number</b> and <b>License Expiry Date</b> matches what is in <b>PRC Image</b>.</i></h2>

    <br>

    <form method="post" action="{{ route('doctorlist.update', $doctorProfile->id) }}">
        @csrf
        @method('PATCH')
        <div class="container">
            <center>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">PRC Number</span>
                        <input type="text" value="{{ $doctorProfile->prcNumber }}" class="form-control" name="prcNumber" required disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">License Expiry Date</span>
                        <input type="text" value="{{$doctorProfile->licenseExpiryDate }}" class="form-control" name="licenseExpiryDate " required disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">PRC Image</span>
                        <br>
                        <a href="{{ $doctorProfile->prcImage }}" target="_blank">
                            <img src="{{ $doctorProfile->prcImage }}" width="200" height="150">
                        </a>
                    </div>
                    <div class="input-box">
                        <span class="details">Account Status</span>
                        <select name="isVerified" value="{{$doctorProfile->isVerified}}" class="form-control"}} required>
                            <option selected disabled hidden>{{$doctorProfile->isVerified }}</option>
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                            <option value="Change">Change Request</option>
                        </select>
                    </div>
                    <br>
                </div>
                <button class="btn btn-primary">Save</button>
            </center>
        </div>
    </form>
</div>
</body>
</html>
