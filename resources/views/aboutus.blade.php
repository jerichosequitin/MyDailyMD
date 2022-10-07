<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - About Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Internal CSS -->
    <style>
        .container-fluid{
            background-size: 100% 100%;
            background-attachment: fixed;
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
            font-size: larger;
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
            background-size:contain;
            background-position-y: top;
            background-position-x: right;
            background-repeat:round;
            text-align: center;
        }
        p{
            text-align: center;
            font-size: medium;

        }
        .button1{
            border: none;
            color: black;
            padding: 10px 10px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
        }
        .signUpBtn{
            border: none;
            color: black;
            padding: 10px 10px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
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
    </style>
</head>
<body>
<div class="topnav">
    <a href="/">Home</a>
    <a href="aboutus" class="active">About Us</a>
    <a href="subscriptionplan">Subscription</a>
    <a href="contactus">Contact Us</a>
</div>

<div class="container">
    <br>

    <h1>What you need to know about <i style="color: #028adf">MyDailyMD!</i></h1>

    <br>

    <p>MyDailyMD is a web-based application made by three students from De La Salle-College of Saint Benilde (DLS-CSB) that focuses on catering the needs of Medical Professionals when it comes to organizing their Health Records.
        As we are slowly embracing the world of technology, the need to protect and provide the needs of Medical Professionals must be prioritized.
        And from that, MyDailyMD was made with love. MyDailyMD offers different features such as: Create, Retrieve, Update and Delete of Health Records, SMS Appointment Reminders, Doctor Dashboard, and Patient Dashboard. </p>

    <br>

    <h3>What are you waiting for? <i style="color: #028adf">Join the growing family of MyDailyMD!</i></h3>

    <br>
</div>
<a href="mainsignuppage">
    <button class="btn btn-primary" name="signUp" class="signUpBtn">Sign Up</button>
</a>
</body>
</html>
