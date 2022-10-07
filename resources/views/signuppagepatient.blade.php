<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Sign Up (Patient)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Internal CSS -->
    <style>
        .container{
            width: 100%;
            background: #EAFAFF;
            padding: 25px 30px;
            border-radius: 5px;

        }
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
        form .input-box span.details{
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
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

        .row{
            content: "";
            display: table;
            clear: both;
            text-align: center;
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
            background-image: linear-gradient(to left, white, rgb(180, 230, 255));
            text-align: center;
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
        .logo{
            float:center;
            text-align: center;
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
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
    <a href="mainsignuppage"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return</a>
    </a>
</div>
<img src="./img/logo.png" width="180" height="180" class="logo">

<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="content">
            <form action="subscriptionbillingpatient">
                <div class="column">
                    <h3><b><u>Personal Information</u></b></h3>
                    <div class="user-details">
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Last Name" name="Last Name" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="First Name" name="First Name" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="M.I." name="M.I." required >
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Honorific" name="Honorific" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Marital Status" name="Marital Status" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Suffix" name="Suffix">
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Gender" name="Gender" required>
                        </div>
                        <div class="input-box">
                            <input type="date" class="form-control" placeholder="Date of Birth" name="Date of Birth" required>
                        </div>
                        <div class="input-box">
                            <input type="email" class="form-control" placeholder="Email Address" name="Email Address" required>
                        </div>
                        <div class="input-box">
                            <input type="password" class="form-control" placeholder="Password" name="Password" required>
                        </div>
                        <div class="input-box">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm Password" required>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <h3><b><u> Contact Information</u></b></h3>
                    <div class="user-details">
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Street Name, Barangay" name="Address" maxlength="50" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="City" name="Address" required>
                        </div>
                        <div class="input-box">
                            <input type="number" class="form-control" placeholder="Postal Code" name="Postal Code" required>
                        </div>
                        <div class="input-box">
                            <input type="tel" class="form-control" placeholder="+63" name="Phone Number" maxlength="10" required>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-control" placeholder="Emergency Contact" name="Emergency Contact" required >
                        </div>
                        <div class="input-box">
                            <input type="number" class="form-control" placeholder="Emergency Contact No." name="Emergency Contact No." required>
                        </div>
                    </div>

                    <p>
                        <input type="checkbox" id="agree" name="agree" value="agree" required> By clicking this button, you agree to MyDailyMD's
                    </p>
                    <a href="termsandconditions" target="blank">Terms & Conditions</a> and
                    <a href="privacypolicy" target="blank">Privacy Policy</a>

                    <br>
                    <br>

                    <center>
                        <a href="subscriptionbillingpatient">
                            <button class="btn btn-primary">Sign Up</button>
                        </a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

