<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - List of Doctor</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="navbar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
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
            text-align:center;
        }
        p{
            font-size: medium;
        }
        table{
            width: 100%;
            text-align: center;
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
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            position:relative;
        }
        .topnav {
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            text-align: left;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="/"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
    </a>
</div>

<img src="./img/logo.png" width="180" height="180" class="logo">

<br>

<div class="container-fluid">
    <h1>List of Doctors</h1>
    <br>
    <table class="table">
        <thead>
        <tr style="background-color:#18A0FB;">
            <th> </th>
            <th>Name</th>
            <th>Schedule</th>
            <th> </th>

            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td><input type="image" src="./img/patient2.png" height="70" width="70"/></td>
            <td>Dr. Belle Santos <br> ENT</td>
            <td>Monday, Wednesday, and Thursday <br> 1:00 - 7:00 PM</td>
            <td><a href="">
                    <button class="btn btn-primary">Book Doctor</button>
                </a></td>

            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td><input type="image" src="./img/patient2.png" height="70" width="70"/></td>
            <td>Dr. Issa Santos <br> Cardiologist </td>
            <td>Monday, Wednesday, and Thursday <br> 1:00 - 7:00 PM</td>
            <td><a href="">
                    <button class="btn btn-primary">Book Doctor</button>
                </a></td>

            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td><input type="image" src="./img/patient2.png" height="70" width="70"/></td>
            <td>Dr. Rovin Santos <br> Pediatrics</td>
            <td>Monday, Wednesday, and Thursday <br> 1:00 - 7:00 PM</td>
            <td><a href="">
                    <button class="btn btn-primary">Book Doctor</button>
                </a></td>

            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td><input type="image" src="./img/patient2.png" height="70" width="70"/></td>
            <td>Dr. Elle Santos <br> Skin and Dermatology</td>
            <td>Monday, Wednesday, and Thursday <br> 1:00 - 7:00 PM</td>
            <td><a href="">
                    <button class="btn btn-primary">Book Doctor</button>
                </a></td>

            <th colspan='2'></th>
        </tr>        </thead>
    </table>
</body>
</html>
