<?php

session_start();

require_once '../config/config.php';


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];


$emailCheckingQuery = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($emailCheckingQuery);


if ($result->num_rows == 0) {

    function generateUserID() {
        $uniqueID = uniqid();

        $uniqueID = substr($uniqueID, 13);

        $randomDigits = mt_rand(1000000000, 9999999999);

        $userID = $uniqueID . $randomDigits;

        return $userID;
    }
    
    function generateUniqueUserID($conn) {
        do {
            $userID = generateUserID();
        } while (isUserIDExistsInDatabase($userID, $conn));

        return $userID;
    }

    function isUserIDExistsInDatabase($userID,$conn) {

        $userIDCheckingQuery = "SELECT * FROM users WHERE userID='$userID'";
        $userIDResult = $conn->query($userIDCheckingQuery);

        return ($userIDResult->num_rows > 0);
    }

    $newUserID = generateUniqueUserID($conn);


    if($password == $confirmPassword){
        

        $setUserQuery = "INSERT INTO users(`userID`, `email`, `firstname`, `lastname`, `password`) VALUES('$newUserID', '$email', '$firstname', '$lastname', '$password')";
        $setUser = $conn->query($setUserQuery);

        if($setUser === TRUE){
            $_SESSION['email'] = $email;

            $getUserQuery = "SELECT userID FROM users WHERE email='$email' AND password = '$password' ";
            $user = $conn->query($getUserQuery);

            while($row = $user->fetch_assoc()) {
                $_SESSION['userID'] = $row['userID'];
            }
            
            header("Location: ../pages/home.php");
            exit(); 
        }
     
    }else{
        header("Location: ../pages/signup.php?error=Confirm the password correctly!");
        exit();
    }
} else {
    header("Location: ../pages/signup.php?error=Email already used!");
    exit();
}


$conn->close();
?>