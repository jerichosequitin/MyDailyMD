<!DOCTYPE html>
<html>
<head>
    <title>Send E-Prescription</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    a{
        text-decoration: none;

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
        margin:0;
        padding:0;
        background-size:contain;
        background-position-y: top;
        background-position-x: right;
        background-repeat:round;
        font-family: 'Poppins'

    }
    p{
        text-align: justify;
        font-size: medium;
    }
    .card{
        width: 40%;
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
    container {
        border-radius: 5px;
        padding: 20px;
        width: 70%;
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
    .label{
        text-align: justify;
    }
</style>
<body>
<img src="./img/logo.png" width="180" height="180" class="logo">
<center>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header" style="background-color:royalblue">
                        <h5 class="card-title" style="color:white">Send E-Prescription</h5>
                        <h2 class="card-body" style="color: white; text-align: center">Kindly make sure to attach the CORRECT E-Prescription to the patient's email.</h2>
                    </div>
                    <div class="class-body">
                    @if(\Session::has('success'))
                        <div class="alert alert-success m-3">{{ \Session::get('success') }}</div>
                        {{ \Session::forget('success') }}
                    @endif
                    @if(\Session::has('error'))
                        <div class="alert alert-danger m-3">{{ \Session::get('error') }}</div>
                        {{ \Session::forget('error') }}
                    @endif
                    <form method="post" action="{{ route('mailSend') }}" enctype="multipart/form-data" class="m-5">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">File upload</label>
                            <input class="form-control" type="file" id="attachment" name="attachment">
                        </div>
                        <input type="submit" name="Send mail" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</center>
</body>
</body>
</html>
