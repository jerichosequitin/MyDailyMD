<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Doctor Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
        .container-fluid{
            background-size: 100% 100%;
            background-attachment: fixed;
            image-rendering:crisp-edges;
            background-image: url("./img/bg01.png");

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
            float:center;
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
        .container-fluid{
            width: 100%;
            margin: 0 auto;
            overflow:hidden;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
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
        .form-control{
            width:80%;
            align-items: center;
        }
        .signInBtn {
            float:center;
            text-align: center;
            display:block;
            margin: 0 auto;
            float: center;
        }
        /* Pen-specific styles */
        *       {
            box-sizing: border-box;
        }
        body {
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            margin:0;
            padding:0;
            text-align: center;
            font-family: 'Poppins'

        }
        section {
            color: black;
            text-align: center;
        }
        div {
            height: 50%;
        }
        /* Pattern styles */
        .container {
            display: table;
            width: 100%;
        }
        .left {
            position: absolute;
            left: 200px;
            width: 18%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;

        }
        .center {
            position: absolute;
            left: 630px;
            width: 18%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;

        }
        .right {
            position: absolute;
            right: 200px;
            width: 18%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;

        }
        .p{
            text-align: center;
        }
        .topnav {
            text-align: right;
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
        }
        .notification {
            display: inline-block;
        }
        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <div class="dropdown">
        <button class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <div class="dropdown-content">
            <a href="doctorprofile/{{Auth::user()->id}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
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
    </div>
</div>
<img src="./img/logo.png" width="180" height="180" class="logo">
<div class="container">

    <br><br>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <h2>Hello, Dr. <b>{{ Auth::user()->name }}</b>! What's your agenda for today?</h2>

    <br>


        <div class="left">
            <a href="doctormanagehealthrecords">
                <input type="image" src="./img/avatar.png" height="180" width="180"/>
            </a>
            <p><b>Health Records</b></p>
        </div>


            <div class="center">
                <a href="prescription">
                    <input type="image" src="./img/medical-prescription.png" height="180" width="180"/>
                </a>
                <p><b>E-Prescription</b></p>
            </div>



            <div class="right">
                <a href="doctorappointment/list">
                    <input type="image" src="./img/appointment.png" height="180" width="180"/>
                </a>
                <h3 class="notification" style="margin-bottom: 100px">
                    <span class="badge">{{$doctorPendingCount}}</span>
                </h3>
                <p><b>Appointments</b></p>
            </div>
</div>
</body>
</html>
