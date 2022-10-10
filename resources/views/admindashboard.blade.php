<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Admin Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Internal CSS -->
    <style>
        .container-fluid{
            background-size: 100% 100%;
            background-attachment: fixed;
            background-image: url("./img/bg.png");
            image-rendering:crisp-edges;
            justify-content: center;
        }
        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            align-items: center;
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
        }
        p{
            text-align: center;
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
            position: relative;
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            overflow: hidden;
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

<img src="./img/logo.png" width="180" height="180" class="logo">

<br><br>

<h1>Hello, <i style="color: #028adf">Admin!</i> What's your agenda for today?</h1>
<h2><i>I would like to view..</i></h2>

<br>

<center>
    <a href="admindoctorlist">
        <button class="btn btn-primary">List of Doctors</button>
    </a>
    <br><br>
    <a href="adminclientlist">
        <button class="btn btn-primary">List of Patients</button>
    </a>
</center>
</body>
</html>
