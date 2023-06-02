<?php


session_start();

   // Get the email and password from the login form
   if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Read the contents of the file into a string
   $fileContents = file_get_contents('../free_users.txt');

   // Explode the file contents by newline character to get each JSON object as a separate string
   $jsonStrings = explode(PHP_EOL, $fileContents);

   // Remove any empty strings
   $jsonStrings = array_filter($jsonStrings);

   // Convert each JSON string to an array
   $dataArray = array_map(function($jsonString) {
       return json_decode($jsonString, true);
   }, $jsonStrings);

   // Check if the $dataArray is empty
   if (empty($dataArray)) {
      $error[] = 'No data found';
   } else {
       // Check if the email and password match with any of the data in the file
       $matchFound = false;
       $emailNotExist = false;
       foreach ($dataArray as $data) {
           if ($data['email'] == $email && $data['password'] == $password) {
               $matchFound = true;
               $userName = $data['name'];
               $emailNotExist= false;
               break;
           }
            else if($data['email'] == $email && $data['password'] != $password){
               $error[] = 'Password is wrong';
               $emailNotExist= false;
               break;
           }else{
            $emailNotExist= true;
           }
       }
       if ($matchFound) {
           // Redirect to the appropriate page based on user type
           
            $_SESSION['user_name'] = $userName;
            $_SESSION['email_info'] = $email;
            header('location:../select_users/free_select_users.php');
            exit;
        
       } 
       if($emailNotExist) {
         $error[] = 'Email is NOT exist!';
       }
   }
} else {
   $error[] = 'Please enter email and password';
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../forms.css">
</head>
<body>

<div class="form-container">

<form method="post" action="">
<div class="text-center">
      <h1 class="mb-3 ">FREE <span class="btn btn-info opacity-75 pe-none text-light fw-bolder rounded-pill">Starter</span></h1>
      <h3>login now</h3>
    </div>
   
   <?php
   if(isset($error)){
      foreach($error as $error){
         echo '<span class="error-msg">'.$error.'</span>';
      };
   }
   ?>

   <input type="email" name="email" required placeholder="enter your email" >
   <input type="password" name="password" required placeholder="enter your password" >
   <input type="submit" name="submit" value="login now" class="form-btn">
   
</form>

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