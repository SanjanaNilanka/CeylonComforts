<?php
session_start();

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
    <title>Properties</title>
</head>
<body>
    <?php
    $where = isset($_GET['where']) ? $_GET['where'] : '';
    $checkIn = isset($_GET['check-in']) ? $_GET['check-in'] : '';
    $checkOut = isset($_GET['check-out']) ? $_GET['check-out'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    
    require_once '../templates/header.php';
    require_once '../templates/search.php';
    ?>
    <br/>

    <?php

    $baseQuery  = "SELECT * FROM properties";

    $whereClause = '';
    if (!empty($where) && !empty($type)) {
        $whereClause = " WHERE town LIKE '$where%' AND category = '$type'";
    } elseif (!empty($where)) {
        $whereClause = " WHERE town LIKE '$where%'";
    } elseif (!empty($type)) {
        $whereClause = " WHERE category = '$type'";
    }
    
    $searchQuery = $baseQuery . $whereClause;

    //$searchQuery = "SELECT * FROM properties WHERE town = '$where' AND category ='$type'";
    $result = $conn->query($searchQuery);

    if($result){
        $rowCount = $result->num_rows;

        $text = 'Results';
        if($rowCount<=1){
            $text = 'Result';
        }

        if($where == ""){
            echo "<div style='font-size: 20px;'>$rowCount $text in Sri Lanka</div>";
        }else{
            echo "<div style='font-size: 20px;'>$rowCount $text for '$where'</div>";
        }


        

    }
    ?>

    <?php
    $cityQuery = "SELECT * FROM towns WHERE townName = '$where'";
    $cityResult = $conn->query($cityQuery);

    $cityName = 'Result';
    $distictName = '';
    $provinceName = '';

    $html = "";

    if($cityResult){
        if($cityResult->num_rows > 0){
            $cityRow = $cityResult->fetch_assoc();

            $cityID = $cityRow['townID'];
            $cityName = $cityRow['townName'];
            $districtID = $cityRow['districtID'];

            $districtQuery = "SELECT * FROM districts WHERE districtID = '$districtID'";
            $districtResult = $conn->query($districtQuery);

            if($districtResult){
                if($districtResult->num_rows > 0){
                    $districtRow = $districtResult->fetch_assoc();

                    $distictName = $districtRow['districtName'];
                    $provinceID = $districtRow['provinceID'];

                    $provinceQuery = "SELECT * FROM provinces WHERE provinceID = '$provinceID'";
                    $provinceResult = $conn->query($provinceQuery);

                    if($provinceResult){
                        if($provinceResult->num_rows > 0){
                            $provinceRow = $provinceResult->fetch_assoc();
        
                            $provinceName = $provinceRow['provinceName'];
                        }
                    }
                }
            }
        }
    }

    if($cityResult->num_rows > 0 ){
          echo "
        <div style='width: fit-content; gap: 10px; margin-top: 5px;' class='center-items'>
            <span><a style='color: #0C8CE9;' href=''>Sri Lanka</a></span>
            <i class='fa-solid fa-angle-right'></i>
            <span><a style='color: #0C8CE9;' href=''>$provinceName</a></span>
            <i class='fa-solid fa-angle-right'></i>
            <span><a style='color: #0C8CE9;' href=''>$distictName</a></span>
            <i class='fa-solid fa-angle-right'></i>
            <span><a style='color: #0C8CE9;' href=''>$cityName</a></span>
        </div>
        ";
    }else{
        echo "
        <div style='width: fit-content; gap: 10px; margin-top: 5px;' class='center-items'>
            <span><a style='color: #0C8CE9;' href=''>Sri Lanka</a></span>
            <i class='fa-solid fa-angle-right'></i>
            
            <span>$cityName</span>
        </div>
        ";
    }
  
    ?>

    <br/>

    <div class="property-card-container" >
        <?php
        if($result){
            while($row = $result->fetch_assoc()) {
                $ID = $row['hotelID'];
                $name = $row['hotelName'];
                $address = $row['address'];
                $description = $row['description'];
                //$ratings = $row['categoryURL'];
                $coverImg = $row['coverURL'];
                
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
    
                $words = str_word_count($description, 1);
                $shortDescription = implode(' ', array_slice($words,0,25));

                $roomPrices = array();

                $getRoomQuery = "SELECT * FROM rooms WHERE hotelID = $ID";
                $rooms = $conn->query($getRoomQuery);

                while($room = $rooms->fetch_assoc()){
                    $price = $room['price'];
                    $roomPrices[] = $price;
                }

                $minPrice = min($roomPrices);
                $maxPrice = max($roomPrices);
                
                $facilitiesList = "";
                $facilitiesCount = 0;

                if($parking){
                    $facilitiesList .= '<span><i class="fa-solid fa-square-parking"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($airportShuttle){
                    $facilitiesList .= '<span><i class="fa-solid fa-van-shuttle"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($petsAllowed){
                    $facilitiesList .= '<span><i class="fa-solid fa-paw"></i>&nbsp; &nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($lobby){
                    $facilitiesList .= '<span><i class="fa-solid fa-person-shelter"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($lift){
                    $facilitiesList .= '<span><i class="fa-solid fa-elevator"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($restaurant){
                    $facilitiesList .= '<span><i class="fa-solid fa-utensils"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($gym){
                    $facilitiesList .= '<span><i class="fa-solid fa-dumbbell"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($spa){
                    $facilitiesList .= '<span><i class="fa-solid fa-spa"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($swimmingPool){
                    $facilitiesList .= '<span><i class="fa-solid fa-water-ladder"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($bar){
                    $facilitiesList .= '<span><i class="fa-solid fa-martini-glass"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($laundry){
                    $facilitiesList .= '<span><i class="fa-solid fa-jug-detergent"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }if($roomService){
                    $facilitiesList .= '<span><i class="fa-solid fa-person-walking-luggage"></i>&nbsp; &nbsp;</span>';
                    $facilitiesCount += 1;
                }

                $fourFacilities = "";
                $moreCount = 0;

                if ($facilitiesCount > 0) {
                    // Split the facilitiesList into an array
                    $facilitiesArray = explode('&nbsp; &nbsp;', $facilitiesList);
                
                    // Take the first 4 facilities
                    $fourFacilities = implode('&nbsp; &nbsp;', array_slice($facilitiesArray, 0, 4));
                    $moreCount = $facilitiesCount-4;
                }else{
                    $fourFacilities = $facilitiesList;
                }
    
                echo "
                <a style='color: black;' href='./property.php?id=$ID'>
                <div class='property-card'>
                    
                    <img class='property-card-img' src='$coverImg' alt='image of $ID'/>
                    
                    
                    <div class='property-card-info'>
                        <div class='center-items'>
                            <div class='center-items' style='align-items: normal;flex-direction: column; gap: 2px;'>
                                <span>$name</span>
                                <span style='font-size: 12px;'><i class='fa-solid fa-location-dot'></i> $address</span>
                            </div>
                            <div style='background-color: #0C8CE9; width: 25px; height: 25px; border-radius: 5px;'>
                            </div>
                        </div>
                        <hr style='border: 0.5px solid rgb(0, 0, 0, 0.25);'/>
                        <div style='font-size: 14px; text-align: justify;'>
                            $shortDescription...
                        </div>
                        <hr style='border: 0.5px solid rgb(0, 0, 0, 0.25);'/>
                        <div class='center-items'>
                            <div>LKR $minPrice - $maxPrice </div>
                            <div style='font-size: 14px;'>
                                $fourFacilities
                                <span style='padding: 1px 5px; background-color: black; color: white; border-radius: 5px;'>+$moreCount</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                ";
            }
        }
        ?>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <?php require_once '../templates/footer.php' ?>
</body>
</html>