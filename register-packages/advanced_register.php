<?php 
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   // Check if all required fields have been filled in
   if(!empty($name) && !empty($email) && !empty($pass) && !empty($cpass) && !empty($user_type)) {
   
      
      // Read the contents of the file into a string
   $fileContents = file_get_contents('formdata.txt');

   // Explode the file contents by newline character to get each JSON object as a separate string
   $jsonStrings = explode(PHP_EOL, $fileContents);

   // Remove any empty strings
   $jsonStrings = array_filter($jsonStrings);

      // Convert each JSON string to an array
   $dataArray = array_map(function($jsonString) {
       return json_decode($jsonString, true);
   }, $jsonStrings);

 
      } 
   } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced_Register</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="form-container p-2">

   <form action="" method="post">
   <div class="text-center">
      <h1 class="mb-3 ">ADCANCED <span class="btn btn-primary opacity-75 pe-none">House Control</span></h1>
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
         <select name="user_type">
            <option value="consumer">consumer</option>
            <option value="producer">producer</option>
         </select>
         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>already have an account? <a href="login_form.php">login now</a></p>
      </form>

      </div>

    
</body>
</html>