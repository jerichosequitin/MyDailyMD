<!DOCTYPE html>
<html>
<head>
    <title>MyDailyMD E-Prescription</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="navbar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css">
    a{
        text-decoration: none;

    }
    a.back{
        text-align: left;
        display: block;
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
        border-bottom:0.5px solid black;
        padding-bottom:3px;


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
        text-align: center;
        display:block;
        margin: 0 auto;
        filter: brightness(100%);
        filter: contrast(100%);
        filter: drop-shadow(1px 1px 1px gray);
        position:relative;
    }
    body{
        font-family: 'Roboto Condensed', sans-serif;
        width:50%;
        margin-top:5%;
        margin-left:25%;
        background-image: linear-gradient(to right, white, rgb(180, 230, 255));

    }
    .logo img{
        width:50px;
        height:50px;
        align-content: center;
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .total-right p{
        padding-right:20px;
    }
    .container{
        border-radius: 15px;
        padding: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        border:1px solid black;
        justify-content: space-between;
    }
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type=date], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        required;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }
    @media print {
        #printPageButton {
            display: none;
            border: 1px solid black;
            width:100px;
        }
        .signature{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        input,
        textarea {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 18px;
            text-align:center;
        }
        textarea{
            font-family: Arial;
            font-size: 10px;
        }
    }
</style>
<body>
    <img src="./img/logo.png" width="130" height="130" class="logo">
        <h1>MyDailyMD E-Prescription</h1>
    @foreach($doc as $data)
        <div class="form-group">
                @csrf
                @method('PATCH')
                <b><span class="details">Clinic Name:</span></b>
                <input type="text" id="clinicName" value="{{ $data->clinicName }}" name="clinicName" readonly required>

                <b><span class="details" >Clinic Address:</span></b>
                <input type="text" id="clinicAddress" value="{{ $data->clinicAddress }}"name="clinicAddress" readonly required>

                <b><span class="details" >Date:</span></b>
                <input type="date" id="clinicDate" name="clinicDate" required>

                <b><span class="details" >Patient Name:</span></b>
                <input type="text" id="patientName" name="patientName" required>

                <img src="./img/rx.png" width="50" height="50" class="rx"> <br>
                <textarea id="prescription" class="form-control" name="prescription" style="resize: none; height:100px";></textarea>

            <img src="{{ $data->digitalSignature }}" width="150" height="100" class="signature">
            <b><input type="text" id="doctorName" name="doctorName" value="{{ $data->name }}" readonly required>
            <input type="text" id="prcNumber" name="prcNumber" value="{{ $data->prcNumber }}" readonly required>

            @endforeach
    </div>
        <center>
        <button id="printPageButton" type="button" class="btn btn-primary" onClick="window.print()">Print</button>
        </center>
</body>
</html>
