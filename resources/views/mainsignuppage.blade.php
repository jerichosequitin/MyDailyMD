<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Main Sign Up Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="navbar.css" rel="stylesheet">
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
            width: 15%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;
            border:3px solid black;
        }

        .right-half {
            position: absolute;
            right: 400px;
            width: 15%;
            border-radius: 15px;
            padding: 20px;
            height: 35%;
            background-color:white;
            border:3px solid black;
        }
        .p{
            text-align: center;
        }
        .topnav {
            position: relative;
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            overflow: hidden;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="/"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
</div>

<div class="container">
    <img src="./img/logo.png" width="180" height="180" class="logo">
    <h1>Which one are you?</h1>
    <p><i>I am a...</i></p>

    <br>

    <section class="container">
        <div class="left-half">
            <a href="signuppagepatient">
                <input type="image" src="./img/patienticon.png" height="120" width="100"/>
            </a>
            <p><b>Patient</b></p>
        </div>

        <section class="container">
            <div class="right-half">
                <a href="signuppagenewdoctor">
                    <input type="image" src="./img/doctoricon.png" height="120" width="100"/>
                </a>
                <p><b>Doctor</b></p>
            </div>
        </section>
</body>
</html>
