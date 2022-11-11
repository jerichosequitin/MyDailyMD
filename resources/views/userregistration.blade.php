<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - User Registration</title>
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
        .content form .user-details{
            margin: 20px 0 12px 0;
        }
        form .user-details .input-box{
            margin-bottom: 15px;
            width: 30%;
        }
        form .input-box span.details{
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .user-details .input-box input{
            height: 40px;
            width: 60%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }
        select[name="role_id"]{
            width:60%;
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .user-details .input-box input:focus,
        .user-details .input-box input:valid{
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
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            text-align: center;
            font-family: 'Poppins'

        }
        p{
            text-align: center;
            font-size: medium;

        }
        /* Style inputs with type="text", select elements and textareas */
        input[type=text], input[type=email], input[type=password], select, textarea {
            width: 50%; /* Full width */
            padding: 12px; /* Some padding */
            border: 1px solid #ccc; /* Gray border */
            border-radius: 4px; /* Rounded borders */
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-top: 6px; /* Add a top margin */
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
        .topnav {
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            text-align: left;
        }
        label{
            font-size:medium;
            font-style: italic;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="/"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
    </a>
</div>

<img src="./img/logo.png" width="180" height="180" class="logo">

<div class="container-fluid" align="center">
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="user-details">
            <div class="input-box">
                <label for="role_id">Register as a: </label>
                <select name="role_id" required>
                    <option selected disabled hidden></option>
                    <option value="doctor">Medical Professional</option>
                    <option value="patient">Patient</option>
                </select>
            </div>

            <div class="input-box">
                <input id="firstName" type="text" name="firstName" placeholder="First Name" title="Please Enter your First Name." required autofocus />
            </div>
            <div class="input-box">
                <input id="lastName" type="text" name="lastName" placeholder="Last Name" title="Please Enter your Last Name." required autofocus />
            </div>
            <div class="input-box">
                <input id="email" type="email" name="email" :value="old('email')" placeholder="Email Address" required />
            </div>
            <div class="input-box">
                <input id="password"
                       type="password"
                       name="password"
                       placeholder="Password"
                       required autocomplete="new-password" />
            </div>
            <div class="input-box">
                <input input id="password_confirmation"
                       type="password"
                       placeholder="Confirm Password"
                       name="password_confirmation" required />
            </div>
        </div>

        <br>

        <p>
            <input type="checkbox" id="agree" name="agree" value="agree" required> By clicking this button, you agree to MyDailyMD's
        </p>
        <a href="termsandconditions" target="blank">Terms & Conditions</a> and
        <a href="privacypolicy" target="blank">Privacy Policy</a>

        <br>
        <br>

        <button class="btn btn-primary">Sign Up</button>
    </form>
</div>
</div>
</body>
</html>

