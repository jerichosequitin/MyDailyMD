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
            font-family:helvetica;
            font-size:35px;
            text-align:center;
            right:8;
        }
        h2{
            color:black;
            font-family:helvetica;
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
            font-family: Arial, Helvetica, sans-serif;
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
        /* Pattern styles */
        .container {
            display: table;
            width: 100%;
        }
        .topnav {
            text-align: right;
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
        }
        .dropdown-content {
            height: 80%;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
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
<img src="./img/logo.png" width="180" height="180" class="logo">
@if(session()->get('Error'))
    <div class="alert alert-warning">
        {{ session()->get('Error') }}
    </div><br />
@endif
<div class="container">
    <br><br>

    <h2>Hello, <b>{{Auth::user()->name}}</b>! Your account is currently undergoing profile verification. Please wait for at least <b>1-2 hours</b> upon profile creation to gain access to your account.</h2>

    <br>
</div>
</body>
</html>
