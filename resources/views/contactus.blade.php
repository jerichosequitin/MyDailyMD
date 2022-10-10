<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Contact Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">

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
            background-image: url("./img/bg01.png");
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
            margin:0;
            padding:0;
            background-size:contain;
            background-position-y: top;
            background-position-x: right;
            background-repeat:round;
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
        input[type=text], select, textarea {
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
            border-radius: 5px;
            padding: 20px;
            width: 40%;
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
    </style>
</head>
<body>
<img src="./img/logo.png" width="180" height="180" class="logo">
<div class="topnav" id="myTopnav">
    <a href="/">Home</a>
    <a href="aboutus">About Us</a>
    <a href="subscriptionplan">Subscription</a>
    <a href="contactus" class="active">Contact Us</a>
</div><br>
<h1>How can we help you?</h1>
<h2>Our team is happy to answer your questions. <br>Fill out the form and we’ll be in touch as soon as possible!</h2>
<div class="container">
    <div class="form-group">
        <form action="index" method ="post" id="contactForm">
        <input type="text" id="fullName" name="fullname" placeholder="Last Name, First Name" required>
    </div>
    <input type="text" id="emailAdd" name="emailAdd" placeholder="Email Address" required>

    <textarea id="message" name="message" placeholder="Message" style="height:150px" required maxlength="150"></textarea>
    <center>
        <button class="btn btn-primary" name="sendBtn" class="sendBtn" href="index">Send</button>
    </center>
    </form>
</div>
</div>
</body>
</html>




