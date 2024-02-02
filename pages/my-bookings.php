<?php
session_start();

$userID;

if(!isset($_SESSION['userID'])){
    header("Location: ../pages/home.php");
    exit();
}else{
    $userID = $_SESSION['userID'];
}

require_once '../config/config.php';
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
    <h3>My Bookings</h3>
    <hr/>
    <br/>
    <div class="center-items" style="flex-wrap: wrap; justify-content: space-between;">

        <?php 
        $getBookingsQuery = "SELECT * FROM bookings WHERE clientID = '$userID'";
        $bookings = $conn->query($getBookingsQuery);

        if($bookings){
            while($row = $bookings->fetch_assoc()) {
                $bookingID = $row['bookingID'];
                $hotelID = $row['hotelID'];
                $roomID = $row['roomID'];
                $roomCount = $row['roomCount'];
                $totalPrice = $row['totalPrice'];
                $checkInDate = $row['checkInDate'];
                $checkOutDate = $row['checkOutDate'];

                $roomName = '';
                $roomURL = '';

                $hotelName = '';

                $getHotelQuery = "SELECT * FROM properties WHERE hotelID = '$hotelID'";
                $hotel = $conn->query($getHotelQuery);

                if($hotel){
                    while($hotelRow = $hotel->fetch_assoc()){
                        $hotelName = $hotelRow['hotelName'];
                    }
                }
                
                $getRoomQuery = "SELECT * FROM rooms WHERE roomID = '$roomID'";
                $room = $conn->query($getRoomQuery);

                if($room){
                    while($roomRow = $room->fetch_assoc()){
                        $roomName = $roomRow['roomName'];
                        $roomURL = $roomRow['imgURL'];
                    }
                }

                echo "
                <div class='center-items my-booking-item'>
                    <div class='center-items' style='position: relative;'>
                        <span style='width:45px; '></span>
                        <span class='rotated-span' style='transform: rotate(270deg); '>$bookingID</span>
                        <img src='$roomURL' class='booking'/>
                    </div>
                    
                    <div class='center-items' style='flex-direction: column; align-items:start; width: 55%;'>
                        <span style='font-size:20px; font-weight:500;'>$hotelName</span>
                        <span>$roomName</span> 
                        <div class='center-items' style='gap: 20px; margin-top: 20px;'>
                            <div class='center-items' style='flex-direction: column; align-items: start;gap: 5px;'>
                                <span>No. of Rooms:</span>  
                                <span>Check in Date:</span>  
                                <span>Check out Date:</span> 
                            </div>
                            <div class='center-items' style='flex-direction: column; align-items: start;gap: 5px;'>
                                <span>$roomCount</span>
                                <span>$checkInDate</span>
                                <span>$checkOutDate</span>
                            </div>
                        </div> 
                        
                    </div>
                </div>
                <br/>
                ";
            }
        }

        ?>
    </div>

    


    <?php require_once '../templates/footer.php' ?>
</body>
</html>