<?php

session_start();

require_once '../config/config.php';
$hotelID = '';
$clientID = '';

if(isset($_SESSION['userID'])){
    $clientID = $_SESSION['userID'];
}

if (isset($_GET['hotelID']) ) {
    $hotelID = $_GET['hotelID'];

} else {
    echo "Hotel ID or Room ID is missing in the URL.";
}

$clientName = $_POST['client-name'];
$clientEmail = $_POST['client-email'];
$clientPhone = $_POST['client-phone'];
$passportNIC = $_POST['client-passport-nic'];

$checkInDate = $_POST['check-in-date'];
$checkOutDate = $_POST['check-out-date'];

$room = $_POST['room'];
$roomID = $_POST['room-id'];

$roomCount = $_POST['no-of-rooms'];
$adultsCount = $_POST['no-of-adults'];
$childrenCount = $_POST['no-of-children'];
//$paymentMethod = $_POST['payment-method'];


$getRoomPriceQuery = "SELECT price FROM rooms WHERE roomID = '$roomID'";
$roomPrice = $conn->query($getRoomPriceQuery);
$price = 0;
if ($roomPrice) {
    if ($roomPrice->num_rows > 0) {
        $row = $roomPrice->fetch_assoc();
        $price = $row['price'];
    }
}

$totalPrice = 0;
if($roomCount>=0){
    $totalPrice = $price*$roomCount;
}


function generateBookingID() {
    $uniqueID = uniqid();

    $uniqueID = substr($uniqueID, 13);

    $randomDigits = mt_rand(1000000000, 9999999999);

    $bookingID = $uniqueID . $randomDigits;



    return $bookingID;
}

// Example usage
$bookingID = generateBookingID();


$insertBookingQuery = "INSERT INTO bookings VALUES('$bookingID', '$hotelID', '$roomID', '$roomCount', '$totalPrice', '$clientID', '$clientName', '$clientEmail', '$clientPhone', '$passportNIC', '$checkInDate', '$checkOutDate', '$adultsCount', '$childrenCount', 'Cash')";
if($conn->query($insertBookingQuery) === TRUE){
    header("Location: ../pages/my-bookings.php");
    exit();
}
?>