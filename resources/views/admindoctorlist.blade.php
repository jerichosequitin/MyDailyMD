<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Admin Doctor List</title>
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
            text-align: left;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="adminhomepage"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
</div>
<img src="./img/logo.png" width="180" height="180" class="logo">

<br><br>

<div class="container-fluid">
    <h1>Doctors</h1>
    <h2><i>Below is the list of Doctors registered to MyDailyMD</i></h2>

    <br>

    <table class="table">
        <thead>
        <tr style="background-color:#18A0FB;">
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Specialization</th>
            <th>PRC No.</th>
            <th>License Type</th>
            <th>Expiry Date</th>
            <th>PRC ID</th>
            <th>Action</th>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <th colspan='2'></th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <th colspan='2'></th>
        </tr>
        </thead>
    </table>
</body>
</html>
