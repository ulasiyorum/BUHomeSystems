<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']) || isset($_SESSION['package_type']) )){
    header('location:../login-forms/free_login.php');
}
$allUsers = json_decode(file_get_contents('../sub_users/premium_sub_users.json'));
$currentUsers = array_filter($allUsers, fn($user) => $user->email == $_SESSION['email_info']);
?>
<?php 
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   

   // Check if all required fields have been filled in
   if(!empty($name) && !empty($email) && !empty($pass) && !empty($cpass) ) {
   
      
      $fileContents = file_get_contents('../package-owners/premium_users.txt');
      $jsonStrings = explode(PHP_EOL, $fileContents);
      $jsonStrings = array_filter($jsonStrings);
      $dataArray = array_map(function($jsonString) {
         return json_decode($jsonString, true);
      }, $jsonStrings);

      // password not matched
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }

      if($email != $_SESSION['email_info']) {
         $error[] = 'This email does not match with yours. You can not add a new user!';
   }

      // if user limit exceed
      if (count($currentUsers) >= 3) {
         $error[] = 'Maxiumum user limit exceed. Can not add anymore.';
      }
      
      // If no error has occurred, create the new user account
      if (!isset($error)) {

         // Create an object
         $data = [];
         $data['name'] = $name;
         $data['email'] = $_SESSION['email_info'];

         $allUsers[] = $data;

        //Convert the object to a JSON string
        $jsonString = json_encode($allUsers);
        file_put_contents('../sub_users/premium_sub_users.json', $jsonString);
        
        header("Location: premium_select_users.php"); 
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
    <link rel="stylesheet" href="../forms.css">
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
      <div class="d-flex justify-content-between">
         <h1>Who is using BU Home Systems right now? </h1>
         <div>
            <button onclick="toggleDeleting()" class="px-3 h-100 rounded me-2" id="editBtn" >
               <i class="fa-solid fa-user-pen fa-lg" style="color: black;"></i>
            </button>
            <button onclick="closeForm()" class="px-3 h-100" id="close-form" style="display: none;">
               <i class="fa-solid fa-minus"></i>
            </button>
            <button onclick="openForm()" class="px-3 h-100" id="open-form">
               <i class="fa-solid fa-plus"></i>
            </button>
         </div>
      </div>
    </div>
    


     
<!-- register for other users -->
<div class="form-container p-2 form-popup" id="myForm">

  <form action="" method="post" id="fm">
  <div class="text-center">
   <h1 class="mb-3 ">PREMIUM <span class="btn btn-info opacity-75 pe-none text-light fw-bolder rounded-pill">Security</span></h1>
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
      <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>

   </form>

   </div>

  
   <div class="row mx-auto" id="avatars">
      <div class="col-lg-3 col-md-6 col-sm-12 ">
         <form action="../app-pages/admin.php" method="post" id="admin-form">
            <button name="username" value="<?= $_SESSION['user_name']?>" style="background-color: transparent;">
               <img src="../avatars/av1.jpg" alt="" class="img-fluid rounded-circle">
               <h1 class="text-center rounded text-light mt-2" style="background-color: #6b5b95;"><span><?php echo $_SESSION['user_name'] ?></span></h1>
            </button>
         </form>
      </div>

    <?php foreach($currentUsers as $key => $subUser): ?>

      <div class="col-lg-3 col-md-6 col-sm-12">
            <form action="./delete_premium_user.php" method="post">
            <button name="username" value="<?= $subUser->name ?>" type="submit" style="display: none;" class="js-delete-item bg-danger text-light p-2 float-end"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
            </form>
            <form action="../app-pages/admin.php" method="post">
               <button name="username" value="<?= $subUser->name ?>" type="submit" style="background-color: transparent;">
                  <img src="../avatars/av<?= $key + 2 ?>.jpg" alt="" class="img-fluid rounded-circle">
                  <h1 class="text-center rounded text-light mt-2" style="background-color: #6b5b95;"><span><?= $subUser->name ?></span></h1>
               </button>
            </form>
      </div>

    <?php endforeach; ?>

    <!-- <div class="col-lg-3 col-md-6 col-sm-12">
      
        <img src="avatars/av3.jpg" alt="" class="img-fluid rounded-circle">
      
    </div>  
    <div class="col-lg-3 col-md-6 col-sm-12">
      
        <img src="avatars/av4.jpg" alt="" class="img-fluid rounded-circle">
      
    </div>  -->
    </div> 


<script>
   
  function openForm() {
  document.getElementById("myForm").style.display = "flex";
  document.getElementById("myForm").style.minHeight = "50vh";
  document.getElementById("avatars").style.display = "none";
  document.getElementById("close-form").style.display = "inline-block";
  document.getElementById("open-form").style.display = "none";
  document.getElementById("editBtn").style.display = "none";
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
  document.getElementById("open-form").style.display = "inline-block";
  document.getElementById("close-form").style.display = "none";
  document.getElementById("editBtn").style.display = "inline-block";
  
}

var isDeletingActive = false;
function toggleDeleting() {
   isDeletingActive = !isDeletingActive;
   let buttons =  document.querySelectorAll('.js-delete-item');

   for(i = 0; i < buttons.length; i++) {
      let button = buttons[i];
      button.style.display = isDeletingActive ? 'block' :  'none';
   }

   document.getElementById('admin-form').style.marginTop = isDeletingActive ? '39px' : '0';
   document.getElementById('editBtn').style.backgroundColor = isDeletingActive ? 'red' : '';
   
}

<?php
   if(isset($error)){
      echo 'openForm()';
   }
?>

</script>


</body>
</html>