<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyDailyMD - Patient Medications</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        .container-fluid{
            background-size: 100% 100%;
            background-attachment: fixed;
            background-image: url("./img/bg03.png");
        }

        img{
            filter: brightness(100%);
            filter: contrast(100%);
            filter: drop-shadow(1px 1px 1px gray);
            align-items: center;
        }
        h1{
            text-align:center;
            font-size:large;
        }
        h2{
            font-size:medium;
            text-align:center;
        }
        h3{
            font-size:20px;
            text-align:center;
            color:#EFFCFF;
        }
        body{
            background-color:#EAFAFF;
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
        .sidenav{
            height: 150%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #0184DF;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #EFFCFF;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }
        .main {
            margin-left: 250px; /* Same as the width of the sidenav */
            font-size: 14px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
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
            border-radius: 15px;
            padding: 20px;
            width: 100%;
            height: 50%;
            background-color:#DEF1FD;
            border:1px solid black;
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
    </style>
</head>
<body>
<div class="container-fluid p-5 bg-primary text-black text-center">
    <br><br>
    <div class="sidenav">
        <div class="left-half">
            <h3>
                <b>Katrina Belardo</b>
            </h3>

            <br>

            <input type="image" src="./img/patient2.png" height="120" width="150"/>
        </div>

        <br>

        <a href="patientprofile">Profile</a>
        <br>
        <a href="patientmedicalhistory">Medical History</a>
        <br>
        <a href="patientmedications">Medications</a>
        <br>
        <a href="patientallergies">Allergies</a>
        <br>
        <a href="patientprogressnotes">Progress Notes</a>
        <br>
        <a href="patientimmunization">Immunization</a>
        <br><br>
        <a href="mainpatientdashboard"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a>
    </div>

    <br>

    <div class="main">
        <h1>
            <b>Medications</b>
        </h1>
        <p><i>Managed by the Medical Professional</i></p>
        <div class="row">
            <div class="content">
                <form action="patientprofile">
                    <div class="column">
                        <div class="container">
                            <table class="table">
                                <thead>
                                <tr style="background-color:#18A0FB;">
                                    <th>Medication Name</th>
                                    <th>Dosage</th>
                                    <th>Freq</th>
                                    <th>Physician</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Purpose</th>
                                    <th colspan='2'></th>
                                </tr>
                                <tr style="background-color:#DEF1FD">
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <th colspan='6'></th>
                                </tr>
                                <tr style="background-color:#FFFFFF">
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <th colspan='6'></th>
                                </tr>
                                <tr style="background-color:#DEF1FD">
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <th colspan='6'></th>
                                </tr>
                                <tr style="background-color:#FFFFFF">
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <th colspan='6'></th>
                                </tr>
                                <tr style="background-color:#DEF1FD">
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <td>Sample</td>
                                    <th colspan='6'></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
