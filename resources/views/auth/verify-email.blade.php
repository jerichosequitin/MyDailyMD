<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Verify Email</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
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
            font-family:Poppins;
            font-size:20px;
            text-align:center;
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
        body{
            background-color:#EAFAFF;
            background-size:contain;
            background-position-y: top;
            background-position-x: right;
            background-repeat:round;
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
        .topnav {
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            text-align: right;
        }
        .dropdown-content {
            height: 80%;
        }
    </style>
</head>
<body>
{{--<div class="topnav" id="myTopnav">--}}
{{--    <div class="dropdown">--}}
{{--        <button class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>--}}
{{--        <div class="dropdown-content">--}}
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}

{{--                <a :href="route('logout')"--}}
{{--                   onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                    <i class="fa fa-sign-out" aria-hidden="true"></i>--}}
{{--                    {{ __('Log Out') }}--}}
{{--                </a>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<img src="./img/logo.png" width="180" height="180" class="logo">
<br>
<div class="container">
    <br><br>
    <h2><b><i>Time to verify your email!</i></b></h2>
    <br>
    <h2>Hello, <b>{{Auth::user()->name}}</b>! Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</h2>

    <br>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                    <button class="btn btn-primary">
                        {{ __('Resend Verification Email') }}
                    </button>
            </form>
        </div>
</div>
</body>
</html>
