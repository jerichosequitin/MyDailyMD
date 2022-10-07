<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Health Records (Doctor)</title>
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
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            overflow: hidden;
            text-align: left;
        }
        .topnav .search-container {
            float: right;
        }
        .topnav input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
        }
        .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }
        .topnav .search-container button:hover {
            background: #ccc;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="maindoctordashboard"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<img src="./img/logo.png" width="180" height="180" class="logo">

<br><br>

<div class="container-fluid">
    <h1>Manage Health Records</h1>

    <br>

    <table class="table">
        <thead>
        <tr style="background-color:#18A0FB;">
            <th style="width:10%">ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th colspan='2' style="width:10%">Actions</th>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Manila</td>
            <td>
                <button type="button">
                    <img src="./img/viewUser.png" height ="80%" width="80%" />
                </button>
            </td>
            <td>
                <button type="button">
                    <img src="./img/removeUser.png" height ="80%" width="80%" />
                </button>
            </td>
        </tr>
        <tr style="background-color:#FFFFFF">
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Makati</td>
            <td>
                <button type="button">
                    <img src="./img/viewUser.png" height ="80%" width="80%" alt="View Patient"/>
                </button>
            </td>
            <td>
                <button type="button">
                    <img src="./img/removeUser.png" height ="80%" width="80%" alt="Remove Patient"/>
                </button>
            </td>
        </tr>
        <tr style="background-color:#DEF1FD">
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Sample</td>
            <td>Pasay</td>
            <td>
                <button type="button">
                    <img src="./img/viewUser.png" height ="80%" width="80%" />
                </button>
            </td>
            <td>
                <button type="button">
                    <img src="./img/removeUser.png" height ="80%" width="80%" />
                </button>
            </td>
        </tr>
        </thead>
    </table>
</body>
</html>
