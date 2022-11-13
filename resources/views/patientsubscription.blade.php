<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Subscription Billing (Patient)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
            background-image: url("./img/bg.png");
        }
        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            align-items: center;
        }
        h1{
            text-align:center;
            font-size:x-large;
        }
        h2{
            font-size:medium;
            text-align:center;
        }
        h3{
            font-size:20px;
            text-align:center;
        }
        body{
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            margin:0;
            padding:0;
            text-align: center;
            font-family: 'Poppins'

        }
        p{
            text-align: justify;
            font-size: medium;

        }
        .button1{
            background-color: none;
            border: none;
            color: black;
            padding: 10px 10px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
        }
        .signUpBtn{
            background-color: none;
            border: none;
            color: black;
            padding: 10px 10px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
        }
        /* Style inputs with type="text", select elements and textareas */
        input[type=amount], select, textarea {
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
            width: 30%;
            height: 15%;
            background-color:#DEF1FD;
            border:1px solid black;
        }
        .logo{
            float:center;
            text-align: center;
            display:block;
            margin: 0 auto;
            float: center;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            position:relative;
        }
        .topnav {
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            text-align: right;
        }
    </style>
</head>
<body>
{{--<div class="topnav" id="myTopnav">--}}
{{--    <form method="POST" action="{{ route('logout') }}">--}}
{{--        @csrf--}}
{{--        <a :href="route('logout')"--}}
{{--           onclick="event.preventDefault();--}}
{{--                     this.closest('form').submit();">--}}
{{--            <i class="fa fa-sign-out" aria-hidden="true"></i>--}}
{{--            {{ __('Log Out') }}--}}
{{--        </a>--}}
{{--    </form>--}}
{{--</div>--}}

<img src="./img/logo.png" width="180" height="180" class="logo">
<h3>Gain access to features such as Health Records, Appointments, and SMS Reminders.</h3>
<br>
<div class="container">
    <div class="card-body">

    <h1><b>Patient Plan</b></h1>
    <br>
    <form action="{{ url('charge') }}" method="post">
        <h2>Amount to Pay: Php <b>750.00</b> (One-Time)</h2>
        <br>
        <input type="text" name="amount" value="750.00" readonly required hidden/>
        {{ csrf_field() }}
        <br>
        <input type="submit" name="submit" value="Pay Now">
    </form>


</div>
</div>
</body>


</html>
