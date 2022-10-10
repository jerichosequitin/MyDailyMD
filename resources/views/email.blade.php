
<!doctype html>
<html lang="en">
<head>
    <title>Send Email Using PHPMailer in Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
</head>
<!-- Internal CSS -->
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
    }
    p{
        text-align: justify;
        font-size: medium;
    }
    .card{
        width: 400px;
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
        width: 70%;
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
</style>
<body>
<img src="./img/logo.png" width="180" height="180" class="logo">
<div class="topnav" id="myTopnav">
    <a href="/">Home</a>
    <a href="aboutus">About Us</a>
    <a href="subscriptionplan">Subscription</a>
    <a href="email" class="active">Contact Us</a>
</div><br>
<h1>How can we help you?</h1>
<h2>Fill out the form and we’ll be in touch as soon as possible!</h2>
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-sm-12 col-12 m-auto">
            <form action="{{route('send-email')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow">
                    @if(Session::has("success"))
                        <div class="alert alert-success alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('success')}}</div>
                    @elseif(Session::has("failed"))
                        <div class="alert alert-danger alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('failed')}}</div>
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="emailRecipient">Email To </label>
                            <input type="email" name="emailRecipient" id="emailRecipient" class="form-control" placeholder="mydailymd@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="emailSubject">Email from</label>
                            <input type="text" name="emailSubject" id="emailSubject" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="emailBody">Message </label>
                            <textarea name="emailBody" id="emailBody" class="form-control" placeholder="Compose message.." required></textarea>
                        </div>

                        <center>
                        <button type="submit" class="btn btn-primary">Send</button>
                        </center>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
