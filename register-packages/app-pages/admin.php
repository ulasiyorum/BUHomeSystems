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

if(isset($_SESSION['package_type'])) {
    $packageType=  $_SESSION['package_type'] ;
}else {
    $packageType = ''; // Set a default value if the username is not available
}

if(isset($_POST['userType'])) {
    $userType=  $_POST['userType'] ;
}else {
    $userType = ''; // Set a default value if the username is not available
}


$data = array('username' => $username, 'package' => $packageType, 'userType' => $userType); // Create an associative array
$jsonData = json_encode($data); // Convert the array to JSON format

// Store the JSON data in a file
$file = 'userInfo.json';
file_put_contents($file, $jsonData);
print_r($file);

if ($userType == "admin") {
    header('Location: random.html');
} else {
    header('Location: random2.html');
}
?>

