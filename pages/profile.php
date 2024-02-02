<?php
session_start();
require_once '../config/config.php';
$userID;

if(!isset($_SESSION['userID'])){
    header("Location: ../pages/home.php");
    exit();
}else{
    $userID = $_SESSION['userID'];
}

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

$getuserQuery = "SELECT * FROM users WHERE userID = '$userID'";
$user = $conn->query($getuserQuery);

if($user){
    if ($user->num_rows > 0) {
        $row = $user->fetch_assoc();

        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $dob = $row['dob'];
        $nationality = $row['nationality'];
        $gender = $row['gender'];
        $address = $row['address'];
        $NIC = $row['NIC'];
        $passportNum = $row['passportNum'];
        $propertyOwner = $row['propertyOwner'];
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff7dc838b1.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php require_once '../templates/header.php' ?>
    <br/>

    <div class="center-items">

        <div class="center-items" style="gap: 15px;">
            <span class="profile-letter-img">
                <?php
                    $firstLetter = ucwords(substr($firstName, 0, 1));
                    echo $firstLetter;
                ?>
            </span>
            <span class="center-items" style="flex-direction: column; align-items: start;">
                <span style="font-size: 24px; font-weight: 500;"><?php echo $firstName.' '.$lastName ?></span>
                <span><?php echo $email ?></span>
            </span>
        </div>
        <div>
            <a><button onclick="showPopup('password')" class="primary">Change Password</button></a>
            <a><button class="primary">Delete Account</button></a>
        </div>
        
    </div>
    
    <h2 style="margin-top: 30px;">Persional Details</h2>
    
    <div id="profle-popup" class="profle-popup">
        <div id="inner-container">

        </div>
    </div>

    <script>
        function showPopup(name) {
            document.getElementById("profle-popup").style.display = "block";
            var innerContainer = document.getElementById("inner-container")
            if(name == "name"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Edit your Name</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input name='firstname' placeholder='First Name' class='booking' value='<?php echo $firstName?>'/>
                    <input name='lastname' placeholder='Last Name' class='booking' value='<?php echo $lastName?>'/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }if(name == "email"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Edit Your Email</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input name='email' placeholder='Email' class='booking' value='<?php echo $email?>'/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }if(name == "phone"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Edit Your Phone Number</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input name='phone' placeholder='Phone Number (+94 700000000)' class='booking' value='<?php echo $phone?>'/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }
            if(name == "dob"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Edit Your Date of Birth</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input type='date' name='dob' placeholder='DOB' class='booking' value='<?php echo $dob?>'/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }if(name == "nationality"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Select Your Nationality</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input name='nationality' placeholder='Nationality' class='booking' value='<?php echo $nationality?>'/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }if(name == "gender"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Select Your Gender</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input name='gender' placeholder='Gender' class='booking' value='<?php echo $gender?>'/>
                    <select name="gender" id="gender">
                        <option value="<?php ?>">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }if(name == "address"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Edit Your Address</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input name='address' placeholder='Address' class='booking' value='<?php echo $address?>'/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }if(name == "passport"){
                if($nationality === "Sri Lanka"){
                    innerContainer.innerHTML = `
                    <div class='center-items'>
                        <h3>Edit Your NIC Number</h3>
                        <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                    
                    <form method='POST' action='../scripts/edit-profile-process.php'>
                        <input name='nic' placeholder='NIC' class='booking' value='<?php echo $NIC?>'/>
                        <button style='float:right;' type='submit' class='primary'>Save</button>
                    </form>`
                }else{
                    innerContainer.innerHTML = `
                    <div class='center-items'>
                        <h3>Edit Your Passport Number</h3>
                        <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                    
                    <form method='POST' action='../scripts/edit-profile-process.php'>
                        <input name='passportNum' placeholder='Passport Number' class='booking' value='<?php echo $passportNum?>'/>
                        <button style='float:right;' type='submit' class='primary'>Save</button>
                    </form>`
                }
                
            }if(name == "password"){
                innerContainer.innerHTML = `
                <div class='center-items'>
                    <h3>Edit Your Password</h3>
                    <span style='font-size:30px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                </div>
                
                <form method='POST' action='../scripts/edit-profile-process.php'>
                    <input type='password' name='old-password' placeholder='Old Password' class='booking' value=''/>
                    <input type='password' name='new-password' placeholder='New Password' class='booking' value=''/>
                    <input type='password' name='confirm-password' placeholder='Confirm New Password' class='booking' value=''/>
                    <button style='float:right;' type='submit' class='primary'>Save</button>
                </form>`
            }
        
        }

        function closePopup() {
            document.getElementById("profle-popup").style.display = "none";
        }
    </script>

    <hr/>
    <div class="profile-item">
        <span style="font-weight: 700; width: 20%;">Name</span>
        <span style="width: 50%;"><?php echo $firstName.' '.$lastName ?></span>
        <span style="color: #0C8CE9;" onclick="showPopup('name')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700 ; width: 20%;">Email</span>
        <span style="width: 50%;"><?php echo $email?></span>
        <span style="color: #0C8CE9;" onclick="showPopup('email')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700;  width: 20%;">Phone Number</span>
        <span style="width: 50%;">
        <?php 
        if($phone == "" || $phone == null){
            echo "Add your phone number";
        }else{
            echo $phone;
        }
        ?>
        </span>
        <span style="color: #0C8CE9;" onclick="showPopup('phone')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700;  width: 20%;">Date of Birth</span>
        <span style="width: 50%;">
        <?php 
        if($dob == "" || $dob == null || $dob = "0000-00-00"){
            echo "Add your DOB";
        }else{
            echo $dob;
        }
        ?>
        </span>
        <span style="color: #0C8CE9;" onclick="showPopup('dob')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700;  width: 20%;">Nationality</span>
        <span style="width: 50%;">
        <?php 
        if($nationality == "" || $nationality == null){
            echo "Select the country/region you are from";
        }else{
            echo $nationality;
        }
        ?>
        </span>
        <span style="color: #0C8CE9;" onclick="showPopup('nationality')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700;  width: 20%;">Gender</span>
        <span style="width: 50%;">
        <?php 
        if($gender == "" || $gender == null){
            echo "Select your gender";
        }else{
            echo $gender;
        }
        ?>
        </span>
        <span style="color: #0C8CE9;" onclick="showPopup('gender')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700;  width: 20%;">Address</span>
        <span style="width: 50%;">
        <?php 
        if($address == "" || $address == null){
            echo "Add your address";
        }else{
            echo $address;
        }
        ?>
        </span>
        <span style="color: #0C8CE9;" onclick="showPopup('address')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>

    <div class="profile-item">
        <span style="font-weight: 700;  width: 20%;">
        <?php
        if($nationality === "Sri Lanka"){
            echo "NIC";
        }else{
            echo "Passport Details";
        }
        ?>
        </span>
        <span style="width: 50%;">
        <?php 
        if($nationality === "Sri Lanka"){
            if($NIC == "" || $NIC == null){
                echo "Add your NIC number";
            }else{
                echo $NIC;
            }
        }else{
            if($passportNum == "" || $passportNum == null){
                echo "Add your passport";
            }else{
                echo $passportNum;
            }
        }
        
        ?>
        </span>
        <span style="color: #0C8CE9;" onclick="showPopup('passport')"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>
    
    <h2 style="margin-top: 30px;">Payment Details</h2>

    <hr/>
    <div class="profile-item">
        <span style="font-weight: 700; width: 20%;">Payment Cards</span>
        <span style="width: 50%;">No card Added</span>
        <span style="color: #0C8CE9;"><i class="fa-solid fa-pen-to-square"></i></span>
    </div>
    <hr/>


    <?php require_once '../templates/footer.php' ?>
</body>
</html>