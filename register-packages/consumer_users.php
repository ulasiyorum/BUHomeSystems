<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login-forms/free_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumer Landing</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
<div class="container text-center mt-5">

  <div class="float-end">
    <button><span> <i class="fa-sharp fa-solid fa-pen-to-square"></i></span></button>
  </div>

   <div class="container text-light p-3 my-5 rounded" style="background-color:#6b5b95;">
   <h1>Welcome <span class="text-uppercase" style="color: #F6E7D8;"><?php echo $_SESSION['user_name'] ?></span></h1>
   </div>

   <div class="row w-100 justify-content-evenly">
    <div class="col-lg-3 rounded">
      
        <img src="avatars/av1.jpg" alt="" class="img-fluid rounded">
    
    </div>
    <!-- <div class="col-lg-3 rounded">
      
        <img src="avatars/av2.jpg" alt="" class="img-fluid rounded">
      
    </div>
    <div class="col-lg-3 rounded">
      
        <img src="avatars/av3.jpg" alt="" class="img-fluid rounded">
      
    </div>  
    <div class="col-lg-3 ">
      
        <img src="avatars/av4.jpg" alt="" class="img-fluid rounded">
      
    </div> -->
   </div>
   
</div>


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
</body>
</html>