<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']))){
    header('location:login-forms/free_login.php');
}
?>
<?php 
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   

   // Check if all required fields have been filled in
   if(!empty($name) && !empty($email) && !empty($pass) && !empty($cpass) ) {
   
      
      $fileContents = file_get_contents('free_users.txt');
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
         if ($data['email'] != $email) {
            $error[] = 'An account with this email does not exist. You can not add a new user!';
            break;
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
        $filename = 'free_users.txt'; $mode = 'a'; file_put_contents($filename,
        $jsonString . PHP_EOL, FILE_APPEND); 
        header("Location: consumer_users.php"); 
        exit();

        
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
    <title>Consumer Landing</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="forms.css">
    <style>
      .form-popup {
        display: none;
        z-index: 9;
        background-color: #fff;
      }
    </style>
    
</head>
<body>
 
  

    <!-- header -->
    <div class="text-light m-5 p-3 rounded " style="background-color:#6b5b95;">
    <h1>Who is using BU Home Systems right now? <button onclick="openForm()" class="float-end"><i class="fa-solid fa-plus"></i></button></h1>
    </div>


     
<!-- register for other users -->
<div class="form-container p-2 form-popup" id="myForm">

  <form action="" method="post" id="fm">
  <div class="text-center">
   <h1 class="mb-3 ">FREE <span class="btn btn-info opacity-75 pe-none text-light fw-bolder rounded-pill">Starter</span></h1>
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
      <p>already have an account? <a href="#">login now</a></p>
      <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>

   </form>

   </div>
   <div class="row text-center mx-5" id="avatars">
    <div class="col-lg-3 col-md-6 col-sm-12 ">
      
        <img src="avatars/av1.jpg" alt="" class="img-fluid rounded-circle">
    
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
      
        <img src="avatars/av2.jpg" alt="" class="img-fluid rounded-circle">
      
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
      
        <img src="avatars/av3.jpg" alt="" class="img-fluid rounded-circle">
      
    </div>  
    <div class="col-lg-3 col-md-6 col-sm-12">
      
        <img src="avatars/av4.jpg" alt="" class="img-fluid rounded-circle">
      
    </div> 
   </div> 
   


<script>
  function openForm() {
  document.getElementById("myForm").style.display = "flex";
  document.getElementById("myForm").style.minHeight = "50vh";
  document.getElementById("avatars").style.display = "none";
  // document.getElementById("myForm").style.position = "absolute";
  // document.getElementById("avatars").style.flexDirection = "column";
  // document.getElementById("avatars").style.width = "50%";
  // document.getElementById("avatars").firstChild.style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("avatars").style.flexDirection = "row";
  document.getElementById("avatars").style.width = "100%";
  document.getElementById("avatars").style.display = "flex";
  
}

</script>


</body>
</html>