<?php
session_start();
require_once '../config/config.php';
$firstName = "";
$lastName = "";
$userName = "";
$userEmail = "";
$userPhone = "";
$userNIC = "";
$userPassport = "";
$userNationality = "";

if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    $getUserQuery = "SELECT * FROM users WHERE userID='$userID'";
    $users = $conn->query($getUserQuery);

    if ($users) {
        if ($users->num_rows > 0) {
            $user = $users->fetch_assoc();

            $firstName = $user['firstname'];
            $lastName = $user['lastname'];
            $userName = $firstName.' '.$lastName;
            $userEmail = $user['email'];
            $userPhone = $user['phone'];
            $userNIC = $user['NIC'];
            $userPassport = $user['passportNum'];
            $userNationality = $user['nationality'];
        }
    }
}



if (isset($_GET['id'])){
    $ID = $_GET['id'];
}

$query = "SELECT * FROM properties WHERE hotelID = $ID";
$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $hotelName = $row['hotelName'];
        $coverImg = $row['coverURL'];
        $description = $row['description'];
        $address = $row['address'];
        $type = $row['category'];
        $googleMapLink = $row['googleMapLink'];

        $town = $row['town'];
        $district = $row['district'];
        $province = $row['province'];

        $parking = $row['parking'];
        $airportShuttle = $row['airportShuttle'];
        $petsAllowed = $row['petsAllowed'];
        $lobby = $row['lobby'];
        $lift = $row['lift'];
        $restaurant = $row['restaurant'];
        $gym = $row['gym'];
        $spa = $row['spa'];
        $swimmingPool = $row['swimmingPool'];
        $bar = $row['bar'];
        $laundry = $row['laundry'];
        $roomService = $row['roomService'];

        $email = $row['email'];
        $phone = $row['phone'];
        $whatsapp = $row['whatsapp'];
        $website = $row['website'];
        
    } else {

    }
} else {

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
    <script type="text/javascript" src="../js/property.js"></script>
    <title><?php echo $hotelName; ?></title>
</head>
<body> 
    <?php require_once '../templates/header.php' ?>
    <br/>
    <?php
        $imgURLs = [];
        $getImgQuery = "SELECT * FROM `hotel-images` WHERE hotelID = $ID";
        $images = $conn->query($getImgQuery);

        if ($images->num_rows > 0) {
            while ($row = $images->fetch_assoc()) {
                $imgURLs[] = $row['imgURL'];
            }
        }
    ?>
    <div class="images-container">
        <div class="center-items">
            <div style="width: 39%;">
                <img class="property" style="width: 100%;" src="<?php echo $coverImg; ?>"/>
            </div>
            <div style="width: 59%;" class="center-items">
                <img 
                    class="property" 
                    style="width: 48%;" 
                    src="
                        <?php
                        if($imgURLs[0]){
                            echo $imgURLs[0];
                        }else{
                            echo $coverImg;
                        }
                        ?>
                    "/>
                <img 
                    class="property" 
                    style="width: 48%;" 
                    src="
                        <?php
                        if($imgURLs[1]){
                            echo $imgURLs[1];
                        }else{
                            echo $coverImg;
                        }
                        ?>
                    "/>
            </div>
        </div>
        <br/>
        <div class="center-items" style="position: relative;">
            <img 
                class="property" 
                style="width: 59%;" 
                src="
                    <?php
                    if($imgURLs[2]){
                        echo $imgURLs[2];
                    }else{
                        echo $coverImg;
                    }
                    ?>
                "/>
            <img 
                class="property" 
                style="width: 39%;" 
                src="
                    <?php
                    if($imgURLs[3]){
                        echo $imgURLs[3];
                    }else{
                        echo $coverImg;
                    }
                    ?>
                "/>
            <div class="img-overlay">+<?php echo count($imgURLs)-3 ?></div>
        </div>
    </div>
    <div id="hotel-details" class="">
        <div style="margin-top: 20px;" class="center-items">
            <div>
                <div style="font-size: 25px; font-weight: 700;"><?php echo $hotelName ?></div>
                <div><i class='fa-solid fa-location-dot'></i> <?php echo $address ?></div>
            </div>
            <div>
                <button onclick="booking('details')" class="primary">Book Hotel</button>
            </div>
        </div>
        <hr/>
        <div style="text-align: justify;">
            <?php
            $paragraphs = explode("\r\n\r\n", $description);
            foreach($paragraphs as $paragraph){
                echo "<p>$paragraph</p>";
            }
            ?>
        </div>
        <div class="hotel-sub-titles">Facilities</div>
        <?php
        $facilitiesList = "";
        if($parking){
            $facilitiesList .= '<span><i class="fa-solid fa-square-parking"></i> Parking &nbsp; &nbsp; &nbsp;</span>';
        }if($airportShuttle){
            $facilitiesList .= '<span><i class="fa-solid fa-van-shuttle"></i> Airport Shuttle &nbsp; &nbsp; &nbsp;</span>';
        }if($petsAllowed){
            $facilitiesList .= '<span><i class="fa-solid fa-paw"></i> Pets Allowed &nbsp; &nbsp; &nbsp;</span>';
        }if($lobby){
            $facilitiesList .= '<span><i class="fa-solid fa-person-shelter"></i> Lobby &nbsp; &nbsp; &nbsp;</span>';
        }if($lift){
            $facilitiesList .= '<span><i class="fa-solid fa-elevator"></i> Lift &nbsp; &nbsp; &nbsp;</span>';
        }if($restaurant){
            $facilitiesList .= '<span><i class="fa-solid fa-utensils"></i> Restaurant &nbsp; &nbsp; &nbsp;</span>';
        }if($gym){
            $facilitiesList .= '<span><i class="fa-solid fa-dumbbell"></i> Gym &nbsp; &nbsp; &nbsp;</span>';
        }if($spa){
            $facilitiesList .= '<span><i class="fa-solid fa-spa"></i> Spa &nbsp; &nbsp; &nbsp;</span>';
        }if($swimmingPool){
            $facilitiesList .= '<span><i class="fa-solid fa-water-ladder"></i> Swmming Pool &nbsp; &nbsp; &nbsp;</span>';
        }if($bar){
            $facilitiesList .= '<span><i class="fa-solid fa-martini-glass"></i> Bar &nbsp; &nbsp; &nbsp;</span>';
        }if($laundry){
            $facilitiesList .= '<span><i class="fa-solid fa-jug-detergent"></i> Laundry &nbsp; &nbsp; &nbsp;</span>';
        }if($roomService){
            $facilitiesList .= '<span><i class="fa-solid fa-person-walking-luggage"></i> Room Service &nbsp; &nbsp; &nbsp;</span>';
        }

        echo $facilitiesList;
        ?>
        <br/>
        <br/>
        <div class="hotel-sub-titles">Available Rooms</div>
        <?php
        $getRoomsQuery = "SELECT * FROM rooms WHERE hotelID = $ID";
        $rooms = $conn->query($getRoomsQuery);
        ?>
        
        <script>
            var rooms = <?php echo json_encode($rooms->fetch_all(MYSQLI_ASSOC)) ?>;
        </script>
        <div class="center-items" style="padding: 0 15%;">
            
            <span class="arrow" onclick='nextRoom(rooms)'><i class="fa-solid fa-chevron-left"></i></i></span>
            <div id="rooms-container" class='center-items' style="margin-top: 10px; width:60%; ">
       
            </div>
            
            <span class="arrow" onclick='prevRoom(rooms)'><i class="fa-solid fa-chevron-right"></i></span>
        </div>
        <script>
            displayRooms(rooms)
        </script>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="hotel-sub-titles">Contact Details</div>
        <div class="center-items">
            <div class="center-items" style="font-size: 16px; width: 25%;">
                <div class="center-items" style="flex-direction: column; align-items: start; gap: 10px;">
                    <span><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;&nbsp;Address</span>
                    <span><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email</span>
                    <span><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;Phone</span>
                    <span><i class="fa-brands fa-whatsapp"></i>&nbsp;&nbsp;&nbsp;Whatsapp</span>
                    <span><i class="fa-solid fa-globe"></i>&nbsp;&nbsp;&nbsp;Website</span>
                </div>
                <div class="center-items" style="flex-direction: column; align-items: end; gap: 10px;">
                    <span><?php echo $address ?></span>
                    <span><?php echo $email ?></span>
                    <span><?php echo $phone ?></span>
                    <span><?php echo $whatsapp ?></span>
                    <span><?php echo $website ?></span>
                </div>
            </div>
            <div class="map-container">
            <iframe 
                src="<?php echo $googleMapLink ?>" 
                width="100%" 
                height="100%" 
                style="border-radius: 10px; border: #000 1px solid;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>
        </div>
    </div>
    <div id="hotel-form" class="non-visible-booking">
        <div style="margin-top: 20px;" class="center-items">
            <div>
                <div style="font-size: 25px; font-weight: 700;"><?php echo $hotelName ?></div>
                <div>Booking Form</div>
            </div>
            <div>
                <button onclick="booking('form')" class="primary">Back to Detals</button>
            </div>
        </div>
        <hr/>
        <form style="margin-top: 20px;" method="POST" action="../scripts/booking-process.php?hotelID=<?php echo $ID ?>">
            <div class="center-items" style="gap: 20px;">
                <div style="width:50%;">
                    <input 
                        name = "client-name"
                        class="booking" 
                        placeholder="Your Name" 
                        value="<?php echo $userName ?>"
                    />
                    <input 
                        type="email"
                        name = "client-email"
                        class="booking" 
                        placeholder="Your Email" 
                        value="<?php echo $userEmail ?>"
                    />
                    
                </div>
                <div style="width: 50%;">
                    <input 
                        name = "client-passport-nic"
                        class="booking" 
                        placeholder="Passport No / NIC" 
                        value="<?php 
                        if($userNationality == "Sri Lanka"){
                            echo $userNIC;
                        }else{
                            echo $userPassport;
                        }
                        ?>"
                    />
                    <input 
                        name = "client-phone"
                        class="booking" 
                        placeholder="Your Phone" 
                        value="<?php echo $userPhone ?>"
                    />
                    
                </div>  
            </div>
            <div class="center-items" style="gap: 20px;">
                <div style="position: relative; width: 33.3%;">
                    <input 
                        type="date"
                        name = "check-in-date"
                        class="booking" 
                        placeholder="Check-in Date" 
                        value=""
                        required
                    />
                    <label style="background-color: white; font-size: 14px; position: absolute; left: 5px; top: -8px;">
                        Check-in Date
                    </label>
                </div>
                
                <div style="position: relative; width: 33.3%;">
                    <input 
                        type="date"
                        name = "check-out-date"
                        class="booking" 
                        placeholder="Your Name" 
                        value=""
                    />
                    <label style="background-color: white; font-size: 14px; position: absolute; left: 5px; top: -8px;">
                        Check-out Date
                    </label>
                </div>
                
                <div style="position: relative; width: 33.3%;">
                    <input 
                        type="text"
                        name = "room"
                        id = "room"
                        class="booking" 
                        placeholder="Select a Room" 
                        readonly
                        onclick="handleRoomInput()"
                    /> 
                    <input name="room-id" id="room-id" style="display: none;"/>
                    <div class="type-list" id="room-list" style="top: 34px; left: 0px; box-sizing: border-box;">
                        <?php
                        $getRoomsQuery = "SELECT * FROM rooms WHERE hotelID = $ID";
                        $roomResults = $conn->query($getRoomsQuery);
                        
                    
                        while($roomResult = $roomResults->fetch_assoc()) {
                            $rID = $roomResult['roomID'];
                            $rName = $roomResult['roomName'];
                            $rPrice = $roomResult['price'];
                            echo "
                            <div class='type-item' onclick='roomItemClick(\"$rName\",\"$rPrice\")'>
                                $rName
                            </div>
                            ";
                        }
                        ?>
                    </div>
                </div>
                
            </div>
            <div class="center-items" style="gap: 20px;">
                <input 
                    type="number"
                    name = "no-of-rooms"
                    class="booking" 
                    placeholder="No. of Rooms" 
                    value=""
                    min=1
                />
                <input 
                    type="number"
                    name = "no-of-adults"
                    class="booking" 
                    placeholder="No. of Adults" 
                    value=""
                    min=1
                />
                <input 
                    type="number"
                    name = "no-of-children"
                    class="booking" 
                    placeholder="No. of Children" 
                    value=""
                    min=0
                />
            </div>
            <div style="display: flex; justify-content: end;">
                <button type="button" onclick="showPopup()" class="primary">Checkout</button>  
            </div>
            <div id="checkout-popup" class="checkout-popup">
                <div id="inner-container">

                </div>
            </div>
            
        </form>
    </div>
    
    <script>
        function showPopup() {
            document.getElementById("checkout-popup").style.display = "block";
            var innerContainer = document.getElementById("inner-container");

            var checkInDateElement = document.getElementsByName('check-in-date')[0];
            var checkOutDateElement = document.getElementsByName('check-out-date')[0];
            var roomElement = document.getElementsByName('no-of-rooms')[0];

            console.log("CheckInDate Element:", checkInDateElement);
            console.log("CheckOutDate Element:", checkOutDateElement);
            console.log("Number of Rooms Element:", roomElement);

            var checkInDateValue = checkInDateElement instanceof HTMLInputElement ? checkInDateElement.valueAsDate : null;
            var checkOutDateValue = checkOutDateElement instanceof HTMLInputElement ? checkOutDateElement.valueAsDate : null;
            var room = roomElement instanceof HTMLInputElement ? roomElement.value : null;

            var checkInDate = checkInDateValue ? new Date(checkInDateValue) : null;
            var checkOutDate = checkOutDateValue ? new Date(checkOutDateValue) : null;

            var nights = checkInDate && checkOutDate ? calculateNights(checkInDate, checkOutDate) : null;

            console.log("CheckInDate:", checkInDate);
            console.log("CheckOutDate:", checkOutDate);
            console.log("Number of Nights:", nights);
            console.log("Number of Rooms:", room);

            var roomPrice = localStorage.getItem('roomPrice')
            var roomPriceValue = roomPrice ? JSON.parse(roomPrice) : null

            var subTotal = parseFloat(roomPriceValue)*parseFloat(nights)*parseFloat(room)
            var tax = 0

            var total = subTotal + tax

            innerContainer.innerHTML = `
                <div>
                    <div class='center-items'>
                        <div class="hotel-sub-titles">Checkout</div>
                        <span style='font-size:25px; font-weight: 700;' onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                    
                    <div class="center-items">
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <span>Check In Date</span>
                            <span>Check out Date</span>
                            <br/>
                            <span>No of Nights</span>
                            <span>No of rooms</span>
                            <br/>
                            <span>Sub Total</span>
                            <span>Tax and Other Charges</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px; align-items: end;">
                            <span>${checkOutDate ? checkOutDate.toISOString().split('T')[0] : 'N/A'}</span>
                            <span>${checkInDate ? checkInDate.toISOString().split('T')[0] : 'N/A'}</span>
                            <br/>
                            <span>${nights !== null ? nights : 'N/A'}</span>
                            <span>${room || 'N/A'}</span>
                            <br/>
                            <span>${subTotal !== null ? subTotal : 'N/A'}</span>
                            <span>${tax}</span>
                        </div>
                    </div>
                    <hr/>
                    <div class="center-items">
                        <span>Total</span>
                        <span>${total}</span>
                    </div>
                    <br/>
                    <div class="hotel-sub-titles">Payment Details</div>
                    <div class="center-items">
                        <span>Payment Method</span>
                        <span style="display: flex;">
                            <input disabled type="radio" name="payment-method" value="card"/>
                            &nbsp;
                            <label><i class="fa-regular fa-credit-card"></i>&nbsp;Card</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input default type="radio" name="payment-method" value="cash"/>
                            &nbsp;
                            <label><i class="fa-regular fa-money-bill-1"></i>&nbsp;Cash</label>
                        </span>
                    </div>
                    <br/>
                    <br/>
                    <div style="display: flex; justify-content: end;">
                        <button type="submit" class="primary">Confirm Booking</button>  
                    </div>
                </div>
            `;
        }

        function calculateNights(checkInDate, checkOutDate) {
            var timeDifference = checkOutDate.getTime() - checkInDate.getTime();
            return Math.ceil(timeDifference / (24 * 60 * 60 * 1000));
        }



        function closePopup() {
            document.getElementById("checkout-popup").style.display = "none";
        }
    </script>
    <?php require_once '../templates/footer.php' ?>
</body>
</html>