<?php

session_start();

require_once '../config/config.php';

$userID = $_SESSION['userID'];

$firstName = "";
$lastName = "";
$email = "";
$phone = "";
$dob = null;
$nationality = "";
$gender = "";
$address = "";
$NIC = "";
$passportNum = "";
$propertyOwner = null;

if(isset($_POST['firstname']) && isset($_POST['lastname'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    echo "$firstname $lastname $userID";

    $updateQuery = "UPDATE users SET firstname = '$firstname', lastname = '$lastname' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['email'])){
    $email = $_POST['email'];

    $updateQuery = "UPDATE users SET email = '$email' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['phone'])){
    $email = $_POST['phone'];

    $updateQuery = "UPDATE users SET phone = '$phone' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['dob'])){
    $dob = $_POST['dob'];

    $updateQuery = "UPDATE users SET dob = '$dob' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['nationality'])){
    $nationality = $_POST['nationality'];

    $updateQuery = "UPDATE users SET nationality = '$nationality' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['gender'])){
    $gender = $_POST['gender'];

    $updateQuery = "UPDATE users SET gender = '$gender' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['address'])){
    $address = $_POST['address'];

    $updateQuery = "UPDATE users SET address = '$address' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['nic'])){
    $NIC = $_POST['nic'];

    $updateQuery = "UPDATE users SET NIC = '$NIC' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['passportNum'])){
    $passportNum = $_POST['passportNum'];

    $updateQuery = "UPDATE users SET passportNum = '$passportNum' WHERE userID = $userID";
    $update = $conn->query($updateQuery);
    if($update === TRUE){
        header("Location: ../pages/profile.php");
    }else{
        echo "Error occured! Name is not updated";
    }
}if(isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])){
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    $getPasswordQuery = "SELECT password FROM users WHERE userID = $userID";
    $password = $conn->query($getPasswordQuery);

    if($password){
        if ($password->num_rows > 0) {
            $row = $password->fetch_assoc();
            $currentPassword = $row['password'];

            if($currentPassword === $oldPassword){
                if($newPassword === $confirmPassword){
                    $updateQuery = "UPDATE users SET password = '$newPassword' WHERE userID = $userID";
                    $update = $conn->query($updateQuery);
                    if($update === TRUE){
                        header("Location: ../pages/profile.php");
                    }else{
                        echo "Error occured! Name is not updated";
                    }
                }else{
                    echo "Plz confirm password correctly!";
                }
            }else{
                echo "Your old password is incorrect!";
            }
        }
    }

    
}

?>