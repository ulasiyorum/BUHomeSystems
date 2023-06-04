<?php
session_start();

if(!(isset($_SESSION['user_name']) || isset($_SESSION['email_info']))){
    header('location:../login-forms/free_login.php');
}

if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $allUsers = json_decode(file_get_contents('../sub_users/free_sub_users.json'));
    $filteredUsers = array_filter($allUsers, fn($user) => $user->name != $username);

    // If the filtered array is empty, set it as an empty array
    if (empty($filteredUsers)) {
        $filteredUsers = [];
    }

     $jsonString = json_encode(array_values($filteredUsers));
    file_put_contents('../sub_users/free_sub_users.json', $jsonString);
}

header('location:free_select_users.php');

?>