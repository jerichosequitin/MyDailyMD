<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        .user-details .input-box input{
            height: 40px;
            width: 85%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
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
        body{
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            font-family: 'Poppins'
        }
        p{
            font-size: medium;
        }
        /* Style inputs with type="text", select elements and textareas */
        input[type=email], input[type=password], select, textarea {
            width: 70%; /* Full width */
            padding: 12px; /* Some padding */
            border: 1px solid #ccc; /* Gray border */
            border-radius: 4px; /* Rounded borders */
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-top: 6px; /* Add a top margin */
            margin-bottom: 8px; /* Bottom margin */
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
        .logo{
            text-align: center;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="/" class="active">Home</a>
    <a href="aboutus">About Us</a>
    <a href="subscriptionplan">Subscription</a>
    <a href="contactus">Contact Us</a>
</div>
<div class="container">
    <img src="./img/logo.png" width="180" height="180" class="logo">
    <div style="width: 100%">
        <!-- LEFT SIDE OF SCREEN -->
        <div style="width: 60%; height: 100%; float: left;">
            <br>

            <h1>Managing Health Records <br> made easy with MyDailyMD</h1>

            <br>

            <p>
                <img src="./img/greencheck.png" width="20" padding="10px" height="20">
                <i>Create, Retrieve, Update and Delete Health Records</i>
            </p>
            <p>
                <img src="./img/greencheck.png" width="20" padding="10px" height="20">
                <i>SMS Appointment Reminders</i>
            </p>
            <p>
                <img src="./img/greencheck.png" width="20" padding="10px" height="20">
                <i>Doctor Dashboard</i>
            </p>
            <p>
                <img src="./img/greencheck.png" width="20" padding="10px" height="20">
                <i>Patient Dashboard</i>
            </p>
            <img src="./img/design-signin.png" width="300" height="180" class="logo1">
        </div>

        <!-- RIGHT SIDE OF SCREEN -->
        <div style="margin-left: 60%; height: 100%;">
            <form action="action_page.php" method="post">
                <div class="imgcontainer">
                    <br>
                    <img src="./img/avatar.png" alt="Avatar" class="avatar" float="center" width="40" height="40">
                </div>

                <br>

                <div class="container1">
                    <h2>
                        <b>SIGN IN</b>
                    </h2>
                </div>
            </form>

        <br>

        <div class="container1">
            <div class="content">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <input id="email" type="email" name="email" :value="old('email')" placeholder="Email Address" required autofocus>
                    </div>

                    <br>

                    <div class="form-group">
                        <input id="password" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                    </div>

                    <br>
                    <p>
                        <input id="remember_me" type="checkbox" name="remember"> Remember Me
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </p>

                    <button class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    <br>
                    <br>

                    <p>Not registered? <a href="userregistration">Create an account!</a></p>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
