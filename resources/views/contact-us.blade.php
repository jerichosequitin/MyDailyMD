<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyDailyMD - Contact Us</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
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
<div class="topnav" id="myTopnav">
    <a href="/">Home</a>
    <a href="aboutus">About Us</a>
    <a href="subscriptionplan">Subscription</a>
    <a href="contact-us" class="active">Contact Us</a>
</div><br>
<center>
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-user">
                        <div class="card-header" style="background-color:royalblue">
                            <h5 class="card-title" style="color:white"><b>How can we help you?</b></h5>
                            <h2 class="card-body" style="color: white; text-align: center">Fill out the form, and we will be in touch as soon as possible!</h2>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <form method="post" action="contact-us">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Name</b> </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. (Juan Dela Cruz)" name="name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Email</b></label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="e.g. juandelacruz@gmail.com" name="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Phone Number</b></label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="eg. xxxx - xxx - xxxx" name="phone_number">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Subject</b></label>
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="e.g. Issue regarding ..." name="subject">
                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Message</b></label>
                                            <textarea class="form-control textarea @error('message') is-invalid @enderror" placeholder="Compose message..." name="message"></textarea>
                                            @error('message')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="update ml-auto mr-auto">
                                        <button type="submit" class="btn btn-primary btn-round">Send</button>
                                    </div>
                                </div>
</center>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
