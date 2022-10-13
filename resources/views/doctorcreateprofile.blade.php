<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Sign Up (Doctor)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        .content form .user-details{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0 12px 0;
        }
        form .user-details .input-box{
            margin-bottom: 15px;
            width: calc(100% / 2 - 50px);
        }
        select[name="specialization"]{
            margin-bottom: 15px;
            width:85%
        }
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
        .column {
            float: left;
            width: 50%;
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
            margin-right:50px;
        }
        body{
            background-image: linear-gradient(to right, white, rgb(180, 230, 255));
            text-align:center;
            overflow: hidden;
        }
        p{
            text-align: center;
            font-size: medium;

        }
        /* Style inputs with type="text", select elements and textareas */
        input[type=text], select, textarea {
            width: 100%; /* Full width */
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

        /* Add a background color and some padding around the form */
        .container {
            border-radius: 15px;
            padding: 15px;
            width: 50%;
            height: 10%;
            background-color:#DEF1FD;
            border:1px solid black;
            text-align: center;
        }
        .logo{
            text-align: center;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
        }
        .topnav {
            position: relative;
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            overflow: hidden;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="mainsignuppage"><i class="fa fa-arrow-left"></i> Return</a>
</div>

<img src="./img/logo.png" width="180" height="180" class="logo">

<br><br>
<div class="content">
    <form action="doctorclinicinformation">
        <div class="column">
            <h3><b><u>Personal Information</u></b></h3>
            <div class="user-details">
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="First Name" name="doctorFirstName" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Last Name" name="doctorLastName" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Middle Initial" name="middleInitial" required>
                </div>
                <div class="input-box">
                    <select name="specialization" class="form-control" required>
                        <option selected disabled hidden>Specialization</option>
                        <option value="Immunology">Immunology</option>
                        <option value="Anesthesiology">Anesthesiology</option>
                        <option value="Dermatology">Dermatology</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Ophthalmology">Ophthalmology</option>
                        <option value="Pathology">Pathology</option>
                        <option value="Diagnostic radiology">Pediatrics</option>
                    </select>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Phone Number" name="phoneNumber" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Email Address" name="emailAddress" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Confirm Password" name="confirmPassword" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="License Type" name="licenseType" required>
                </div>
                <div class="input-box">
                    <input type="date" class="form-control" placeholder="License Expiry Date" name="licenseExpiryDate" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="PRC Number" name="prcNumber" required>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <div class="column">
            <h4> Upload PRC ID Image</h4>
            <br>
            <div class="container">
                <input type="file" name="prcImage" accept="image/*">
            </div>
            <br>
            <p>
                <i>We use this information to confirm the identities of our registered
                        doctors.
                    <br>
                    We do not share this information with anyone.
                </i>
            </p>
            <br>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
    </form>
</div>
</body>
</html>

