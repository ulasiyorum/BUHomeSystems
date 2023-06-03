<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']))){
    header('location:../login-forms/free_login.php');
}

if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $allUsers = json_decode(file_get_contents('../sub_users/free_sub_users.json'));
    $filteredUsers = array_filter($allUsers, fn($user) => $user->name != $username);
    file_put_contents('../sub_users/free_sub_users.json', json_encode($filteredUsers, JSON_PRETTY_PRINT));
}

header('location:free_select_users.php');

?>