<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Clinic Information (Yes)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="navbar.css" rel="stylesheet">
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
            width: calc(100% / 2 - 50px);
        }
        form .input-box span.details{
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .user-details .input-box input{
            height: 50px;
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
        select{
            width: 85%;
        }
        .column {
            float: left;
            width: 50%;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
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
            text-align:center;
            overflow: hidden;
        }
        p{
            text-align: center;
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
            padding: 20px;
            width: 40%;
            height: 15%;
            background-color:#DEF1FD;
            border:1px solid black;
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
    <a href="doctorclinicinformation"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>
<img src="./img/logo.png" width="180" height="180" class="logo">

<br><br>
<div class="content">
    <form action="doctorclinicinformation">
        <div class="column">
            <h3><b><u>Clinic Information</u></b></h3>
            <div class="user-details">
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Hospital Name" name="Hospital Name" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Clinic Name" name="Clinic Name" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Clinic Mobile Number" name="Clinic Mobile Number" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Clinic Telephone Number" name="Clinic Telephone Number" required>
                </div>
                <div class="input-box">
                    <input type="text" class="form-control" placeholder="Room/Wing/Bldg" name="Room/Wing/Bldg" required>
                </div>
            </div>
        </div>
        <div class="column">
            <h3><b><u>Availability</u></b></h3>
            <select name="days" id="date" style="max-width:50%;">
                <option value="select" selected hidden disabled>Select for Available Day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <select name="time" id="time" style="max-width:50%;">
                <option value="select" selected hidden disabled>Select for Available Time</option>
                <option value="time1">8:00-9:00 AM</option>
                <option value="time2">10:00-11:00 AM</option>
                <option value="time3">11:00 - 12:00 NN</option>
                <option value="time4">1:00 - 2:00 PM</option>
                <option value="time5">3:00 - 4:00 PM</option>
                <option value="time6">5:00 - 6:00 PM</option>
            </select>
            <p>
                <input type="checkbox" id="agree" name="agree" value="agree" required> By clicking this button, you agree to MyDailyMD's
            </p>
            <a href="termsandconditions" target="blank">Terms & Conditions</a> and
            <a href="privacypolicy" target="blank">Privacy Policy</a>

            <br>
            <br>


            <a href="subscriptionbillingpatient">
                <button class="btn btn-primary">Sign Up</button>
            </a>
        </div>
    </form>
</div>
</div>
</body>
</html>

