<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Subscription Plan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Internal CSS -->
    <style>
        a.back{
            text-align: left;
            display: block;
            text-decoration: none;
        }
        .container-fluid{
            background-size: 100% 100%;
            background-attachment: fixed;
            background-image: url("./img/bg.png");
            image-rendering:crisp-edges;
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
            text-align: center;
            font-size: medium;
        }
        table{
            width: 100%;
            text-align: center;
            table-layout:auto;
        }
        td{
            border-collapse: collapse;
            color:black;
        }
        th{
            color:white;
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
        .table{
            max-width: 800px;
            margin-left:auto;
            margin-right:auto;
        }
        td{
            text-align: center;
        }
    </style>
</head>
<body>
<img src="./img/logo.png" width="180" height="180" class="logo">
<div class="topnav" id="myTopnav">
    <a href="/">Home</a>
    <a href="aboutus">About Us</a>
    <a href="subscriptionplan" class="active">Subscription</a>
    <a href="contact-us">Contact Us</a>
</div>
<br>
<div class="container">
    <table class="table">
        <thead>
        <tr style="background-color:#18A0FB;">
            <th>Features</th>
            <th>Patient</th>
            <th>Medical Professional</th>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td style= text-align:justify>Create, retrieve, update health records</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td style= text-align:justify>Create an e-prescription</td>
            <td><img src="./img/redcross.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td style= text-align:justify>Schedule an appointment</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td style= text-align:justify>Access to medical history record</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td style= text-align:justify>Access to medications record</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td style= text-align:justify>Access to allergies record</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td style= text-align:justify>Take track of progress notes</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td style= text-align:justify>Access to immunization record</td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <td><img src="./img/greencheck.png" width="20" padding="10px" height="20" float:left></td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td style= text-align:justify><b>Subscription price</b></td>
            <td><b>Php 750.00 (one time payment)</b></td>
            <td><b>Php 1,500.00 (monthly)</b></td>
            <th colspan='2'></th>
        </tr>
        </thead>
</body>
</html>
