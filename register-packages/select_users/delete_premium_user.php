<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']))){
    header('location:../login-forms/premium_login.php');
}

if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $allUsers = json_decode(file_get_contents('../sub_users/premium_sub_users.json'));
    $filteredUsers = array_filter($allUsers, fn($user) => $user->name != $username);
    file_put_contents('../sub_users/premium_sub_users.json', json_encode($filteredUsers));
}

header('location:premium_select_users.php');

?>