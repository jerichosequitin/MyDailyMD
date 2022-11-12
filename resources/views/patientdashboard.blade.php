<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Patient Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
        .logo{
            text-align: center;
            display:block;
            margin: 0 auto;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            position:relative;
        }
        body{
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            margin:0;
            padding:0;
            font-family: 'Poppins'

        }
        .container ul{
            list-style: none;
            text-align: justify;
            display:block;
            padding: 0;
            text-align: center;
            display:block;
            margin: 0 auto;
        }
        .container-fluid li{
            display: inline-block;
        }
        .container-fluid a{
            text-decoration: none;
            width:100px;
            display: block;
            font-size:17px;
        }
        img{
            display: inline-block;
            margin: 10px 15px;
        }
        h1{
            color:black;
            font-family:Poppins;
            font-size:35px;
            text-align:center;
            right:8;
        }
        h2{
            color:black;
            font-family:Poppins;
            font-size:20px;
            text-align:center
        }
        i{
            color:black;
            font-family:helvetica;
            font-size:15px;
            text-align:justify
        }
        /* Pen-specific styles */
        *       {
            box-sizing: border-box;
        }
        body {
            font-size: 1.25rem;
            font-family: 'Poppins';
            line-height: 150%;
            text-align: center;
        }

        section {
            color: black;
            text-align: center;
        }

        div {
            height: 50%;
        }
        article {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40%;
            padding: 20px;
        }
        /* Pattern styles */
        .container {
            display: table;
            width: 50%;
        }
        .left-half {
            position: absolute;
            left: 400px;
            width: 18%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;

        }
        .right-half {
            position: absolute;
            right: 400px;
            width: 18%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;

        }
        .topnav {
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            text-align: right;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a :href="route('logout')"
           onclick="event.preventDefault();
                                        this.closest('form').submit();">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            {{ __('Log Out') }}
        </a>
    </form>
</div>

<div class="container">
    <img src="./img/logo.png" width="180" height="180" class="logo">

    <br><br>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <h2>Hello, <b>{{ Auth::user()->name }}</b>! What's your agenda for today?</h2>

    <br>


        <div class="left-half">
            <a href="patientprofile/{{Auth::user()->id}}">
                <input type="image" src="./img/avatar.png" height="180" width="180"/>
            </a>
            <p><b>My Profile</b></p>
        </div>

            <div class="right-half">
                <a href="patientappointment/list">
                    <input type="image" src="./img/appointment.png" height="180" width="180"/>
                </a>
                <p><b>My Appointment</b></p>
            </div>

</div>
</body>

</html>
