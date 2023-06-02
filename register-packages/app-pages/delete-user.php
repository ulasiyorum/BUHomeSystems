<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']))){
    header('location:login-forms/free_login.php');
}
$allUsers = json_decode(file_get_contents('../free_sub_users.json'));
$currentUsers = array_filter($allUsers, fn($user) => $user->name != $_POST['username']);
$currentUsers = array_values($currentUsers);

file_put_contents('../free_sub_users.json', json_encode($currentUsers));
header("Location: ../consumer_users.php"); exit();
?>