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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
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
        font-size:medium;
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
        text-align: center;
        font-size: small;
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
        text-align: center;
        display:block;
        margin: 0 auto;
        filter: brightness(100%);
        filter: contrast(100%);
        filter: drop-shadow(1px 1px 1px gray);
        position:relative;
    }
</style>
<body>
<div class="container">
    <div class="row-2">
        <div class="col-xl-5 col-lg-5 col-sm-12 col-12 m-auto">
            <form action="{{route('send-email')}}" method="POST" enctype="multipart/form-data">
                <div class="card shadow">
                    <img src="/img/logo.png" width="120" height="120" class="logo">
                    <h1> MyDailyMD</h1>
                    <p><i>3/F Walter Mart Center, Chino Roces cor. Arnaiz St., Makati City. </i></p>
                    <p> 09978495843</p>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="patientName">Name</label>
                            <input type="text" name="patientName" id="patientName" class="form-control" value="{{ request('patientName') }}" placeholder="Enter patient name" required>
                        </div>

                        <div class="form-group">
                            <label for="dateToday">Date </label>
                            <input type="date" name="dateToday" id="dateToday" value="{{ request('dateToday') }}" class="form-control"  required>
                        </div>

                        <div class="form-group">
                            <img src="./img/rx.png" width="50" height="50" class="rxlogo">
                            <textarea name="patientPrescription" id="patientPrescription" value="{{ request('patientPrescription') }}" class="form-control" placeholder="Compose prescription.." required></textarea>
                        </div>

                        <div class="form-group">
                            <div class="image-preview" id="imagePreview" style="margin: 1rem 0;">
                                <img src="./assets/images/temp.png" alt="" class="image-preview__image" style="width: 100%; border-radius: 1rem;">
                                <span class="image-preview__default-text"></span>
                            <input type="file" name="inpImage" id="inpImage" class="form-control">
                        </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary" onclick="window.print()">Print</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const inpImage = document.getElementById("inpImage");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    inpImage.addEventListener("change", function() {
        const file = this.files[0];

        if(file){
            const reader = new FileReader();

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";

            reader.addEventListener("load", function(){
                previewImage.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
        } else{
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewImage.setAttribute("src", "");
        }
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
