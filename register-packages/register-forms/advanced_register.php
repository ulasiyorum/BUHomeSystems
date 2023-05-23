<?php 
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   

   // Check if all required fields have been filled in
   if(!empty($name) && !empty($email) && !empty($pass) && !empty($cpass) ) {
   
      
      $fileContents = file_get_contents('../advanced_users.txt');
      $jsonStrings = explode(PHP_EOL, $fileContents);
      $jsonStrings = array_filter($jsonStrings);
      $dataArray = array_map(function($jsonString) {
         return json_decode($jsonString, true);
      }, $jsonStrings);

      // password not matched
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }

      //same email and not more than one admin
      foreach ($dataArray as $data) {
         if ($data['email'] == $email) {
            $error[] = 'An account with this email is already exists.';
            break;
            // Check if the email already exists in the file with user_type = "producer"
         }
      }
      
      // If no error has occurred, create the new user account
      if (!isset($error)) {
         // Create an object
         $data = new stdClass();
         $data->name = $name; 
         $data->email = $email; $data->password = $pass;

   //CREATE AN ARRAY 
   $dataArray = (array) $data; 

   //Convert the object to a JSON string
   $jsonString = json_encode($dataArray);
   $filename = '../advanced_users.txt'; $mode = 'a'; file_put_contents($filename,
   $jsonString . PHP_EOL, FILE_APPEND); 
   header("Location: ../login-forms/advanced_login.php"); exit();
         } 
      } 
   } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Register</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../forms.css">
    
</head>
<body>
<div class="form-container p-2">

<form action="" method="post">
<div class="text-center">
   <h1 class="mb-3 ">ADVANCED <span class="btn pe-none text-light fw-bolder rounded-pill" style="background-color: #0d6efd;">House Control</span></h1>
   <h3>register now</h3>
 </div>
   
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      }
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
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