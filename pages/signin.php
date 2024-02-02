<?php
session_start();

if(isset($_SESSION['userID'])){
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
        <a href="../pages/home.php"><img style="width: 70px;" src="../assets/logo.png"/></a>
        <h2>Welcome Back!</h2>
        <span style="font-size: 20px;">Please enter your details to log in</span>
        <br/>
        <form action="../scripts/login-process.php" method="POST" class="login-form">
            <input required type="email" class="auth" placeholder="Email" name="email" id="email">
            <br/>
            <input required type="password" class="auth" placeholder="Password" name="password" id="password"/>
            <a href="#" style="font-style: italic; text-decoration: none;">Forgot password?</a>  
            <br/>
            <?php
            if (isset($_GET['error'])){
                echo '<p style="color:red; margin-top: -10px; margin-bottom: -10px; text-align:center;">'.$_GET['error'].'</p>';
            }
            ?>
            <button type="submit" class="login">Sign in</button>
        </form>
        <br/>
        <br/>
        <span>Don't have an account? <a href="../pages/signup.php">Sign Up</a></span>
    </div>
    
</body>
</html>