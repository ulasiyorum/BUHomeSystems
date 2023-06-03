<?php
session_start();

if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username; // Store the value in a session variable
} elseif (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Retrieve the value from the session variable
} else {
    $username = ''; // Set a default value if the username is not available
}

$data = array('username' => $username); // Create an associative array
$jsonData = json_encode($data); // Convert the array to JSON format

// Store the JSON data in a file
$file = 'username.json';
file_put_contents($file, $jsonData);
print_r(file_get_contents($file));
?>

