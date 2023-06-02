<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']))){
    header('location:login-forms/free_login.php');
}

echo $_POST['username'];