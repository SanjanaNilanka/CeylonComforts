<?php

session_start();

require_once '../config/config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$authQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($authQuery);

if ($result->num_rows == 1) {
    $_SESSION['email'] = $email;

    $getUserQuery = "SELECT userID FROM users WHERE email='$email' AND password = '$password' ";
    $user = $conn->query($getUserQuery);

    while($row = $user->fetch_assoc()) {
        $_SESSION['userID'] = $row['userID'];
    }
    

    header("Location: ../pages/home.php");
    
    exit();
} else {
    // Redirect back to login.php with an error message
    header("Location: ../pages/signin.php?error=Incorrect username or password");
    exit();
}

$conn->close();
?>