<?php
session_start();

if(isset($_SESSION['email'])){
    header("Location: ../pages/home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/auth.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff7dc838b1.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/types.js"></script>
    <title>Log in</title>
</head>
<body>
    <div style="position: relative; width: 50%;">
        <img style="height: 100vh; width: 100%;" src="https://www.heritancehotels.com/kandalama/wp-content/uploads/sites/18/2019/02/Heritance-Kandalama_Exterior-1-1.jpg"/>
        <div class="img-overview">
            <span class="brand-name">CeylonComforts</span>
        </div>
    </div>
    <div class="login-container">
        <a href="../pages/home.php"><img style="width: 60px;" src="../assets/logo.png"/></a>
        <h2 style="margin-top: 0;">Sign Up</h2>
        <form action="../scripts/signup-process.php" method="POST" class="login-form">
            <input type="text" class="auth" placeholder="First Name" name="firstname"/>
            <br/>
            <input type="text" class="auth" placeholder="Last Name" name="lastname"/>
            <br/>
            <input type="email" class="auth" placeholder="Email" name="email"/>
            <br/>
            <input type="password" class="auth" placeholder="Password" name="password"/>
            <br/>
            <input type="password" class="auth" placeholder="Confirm Password" name="confirm-password"/>
            <br/>
            <button type="submit" class="login">Sign in</button>
        </form>
        <br/>
        <br/>
        <span>Do you have an account? <a href="../pages/signin.php">Sign In</a></span>
    </div>
    
</body>
</html>