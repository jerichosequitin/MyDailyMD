<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body{
        background-image: linear-gradient(to right, white, rgb(180, 230, 255));
        background-size:contain;
        background-position-y: top;
        background-position-x: right;
        background-repeat:round;
        margin: auto;
    }

</style>
</head>
<body>
<div class="container">
    <img src="./img/logo.png" width="180" height="180" class="logo">
    <div class="topnav" id="myTopnav">
        <a href="/" class="active">Home</a>
        <a href="aboutus">About Us</a>
        <a href="subscriptionplan">Subscription</a>
        <a href="email">Contact Us</a>
    </div>
    <div style="width: 80%">
        <!-- LEFT SIDE OF SCREEN -->
        <div style="width: 70%; height: 80%; float: left;">
            <br>

            <h1>Managing Health Records <br> made easy with MyDailyMD</h1>

            <br>

            <img src="./img/greencheck.png" width="20" padding="10px" height="20">
            <i>Create, Retrieve, Update and Delete Health Records</i><br>
            <img src="./img/greencheck.png" width="20" padding="10px" height="20">
            <i>SMS Appointment Reminders</i><br>
            <img src="./img/greencheck.png" width="20" padding="10px" height="20">
            <i>Doctor Dashboard</i><br>
            <img src="./img/greencheck.png" width="20" padding="10px" height="20">
            <i>Patient Dashboard</i><br>
            <img src="./img/design-signin.png" width="300" height="180" class="logo1">
        </div>

        <!-- RIGHT SIDE OF SCREEN -->
        <div style="margin-left: 70%; height: 50%;">
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
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" value="" placeholder="Email Address">
                        </div>

                        <br>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" value="" placeholder="Password">
                        </div>

                        <br>

                        <p>
                            <input type="checkbox"> Remember Me &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <a href="forgotpassword">Forgot Password?</a>
                        </p>

                        <button class="btn btn-primary" name="signInBtn" class="signInBtn">Sign In</button>

                        <br>
                        <br>

                        <p>Not registered? <a href="mainsignuppage">Create an account!</a></p>
                        <br>
                        </a>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
