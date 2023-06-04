<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    />
    <style>
        #package{
            transition: 0.5s;
        }
        #package:hover{
            transform: scale(1.2);
            z-index: 2;
        }
    </style>
</head>
<body class="bg-light bg-gradient">
    <div class="container text-center">
        <h1 class="text-light mt-4 rounded-top" style="background-color: #6b5b95;">WELCOME TO BU HOME SYSTEMS</h1>
        <div class="img-wrap text-center">
        <img src="../Images/Brand/Logo/Dark/logo_transparent.png" class="w-25" alt="Home image">
        </div>
    
        <h2 style="color: #6b5b95;">Please Select Your Plan to Login</h2>

    </div>

        <div class="row my-5 text-center">

                <div class="col" id="package">
                    <a href="login-forms/free_login.php" class="mb-3 fs-2 text-decoration-none text-secondary">FREE <span class="btn btn-info opacity-75 pe-none text-light fw-bolder rounded-pill">Starter</span></a>
                </div>

                <div class="col" id="package">
                <a href="login-forms/premium_login.php" class="mb-3 fs-2 text-decoration-none text-secondary">Premium <span class="btn pe-none text-light fw-bolder rounded-pill" style="background-color: #6c757d;">Advanced</span></a>
                </div>
            
            </div>
        </div>
    
    
    
    
</body>

<script
   src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
   integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
   crossorigin="anonymous"
 ></script>
 <script
   src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
   integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
   crossorigin="anonymous"
 ></script>
</html>