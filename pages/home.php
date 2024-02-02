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
    <script type="text/javascript" src="../js/home.js"></script>
    <title>CeylonComforts</title>
</head>
<body>
    <?php
    require_once '../config/config.php'
    ?>
    <?php
    require_once '../templates/header.php'
    ?>
    <?php
    require_once '../templates/search.php'
    ?>
    
    
    <?php
    $getTypesQuery = "SELECT * FROM categories";
    $types = $conn->query($getTypesQuery);

    /*while($row = $types->fetch_assoc()) {
        $tID = $row['categoryID'];
        $tName = $row['categoryName'];
        $tURL = $row['categoryURL'];
        echo "
        <div>
            <img class='types' src='$tURL' alt='image of $tName'/>
            <div>$tName</div>
        </div>
        ";
    }*/
    ?>
    
    <script>
        var types = <?php echo json_encode($types->fetch_all(MYSQLI_ASSOC)) ?>;

    </script>

    
    <br/>
    <div class='center-items'>
        <h2>Types</h2> 
        <div style="display: flex; gap: 15px;">
            <span class="arrow" onclick='next(types)'><i class="fa-solid fa-chevron-left"></i></i></span>
            <span class="arrow" onclick='prev(types)'><i class="fa-solid fa-chevron-right"></i></span>
        </div>  
    </div>
    <div id="types-container" class='center-items' style="margin-top: 10px;">
       
    </div>
     
    <script>
        displayTypes(types)        
        //test();
        
    </script>
    
    
    


    <br/>
    <div class='center-items'>
        <h2>Popular Locations</h2> 
        <div style="display: flex; gap: 15px;">
            <span class="arrow" onclick='nextLocation(types)'><i class="fa-solid fa-chevron-left"></i></i></span>
            <span class="arrow" onclick='prevLocation(types)'><i class="fa-solid fa-chevron-right"></i></span>
        </div>  
    </div>

    <div id="locations-container" class='center-items' style="margin-top: 10px;">
       
    </div>
     
    <script>
        displayLocations()        
        //test();
        
    </script>


    <?php
    $getHotelsQuery = "SELECT * FROM properties";
    $hotels = $conn->query($getHotelsQuery);
    ?>
    
    <script>
        var hotels = <?php echo json_encode(array_slice($hotels->fetch_all(MYSQLI_ASSOC), 0, 10)) ?>;
    </script>


    <div class='center-items' style="margin-top: 110px;">
        <h2>Hotel & Other Properties</h2> 
        <div style="display: flex; gap: 15px;">
            <span class="arrow" onclick='nextHotel(hotels)'><i class="fa-solid fa-chevron-left"></i></i></span>
            <span class="arrow" onclick='prevHotel(hotels)'><i class="fa-solid fa-chevron-right"></i></span>
        </div>  
    </div>

    <div id="hotels-container" class='center-items' style="margin-top: 10px;">
       
    </div>
    
    <script>
        displayHotels(hotels)        
        //test();
        
    </script>

    
    <div class="about-sl-container">
        <div class="about-sl-content">
            <div style="font-size: 18px;">Nestled in the heart of Sri Lanka, our hotel is a gateway to the island's diverse wonders. Immerse yourself in the enchanting blend of pristine beaches, lush tea plantations, and ancient temples that characterize this tropical paradise. As you step into our sanctuary, experience the warm hospitality that defines Sri Lankan culture.
            <br/>
            <br/>
            Savor the rich flavors of local cuisine, a tantalizing journey for your taste buds. Our hotel offers a haven of comfort, inviting you to unwind after a day of exploration. Whether you're drawn to the serenity of our surroundings or the vibrant local markets, our location provides easy access to the island's diverse attractions.</div>
            <button class="primary">Reserve Your Place</button>
        </div>
        <div class="about-sl-img">
            <img style="width: 100%; height: 100%;" id="carousel-image" />
            <span class="about-sl-img-tag" id="img-tag"></span>
        </div>
    </div>

    <script>
        var aboutImg = [
            'https://th.bing.com/th/id/OIP.cNAyiT7z_bzHHug2EVnmiQHaE7?rs=1&pid=ImgDetMain',
            'https://infolanka.lk/wp-content/uploads/2018/09/adams-peak.jpg',
            'https://smapse.com/storage/2021/08/converted/895_0_ambuluwawa-bashnya-smapse.jpg'

        ]

        var aboutImgTag = [
            'Sigiriya, Sri Lanka',
            'Sri Padaya, Sri Lanka',
            'Ambuluwawa Tower, Sri Lanka'
        ]

        var currentImageIndex = 0;

        function changeImage() {
            var imageElement = document.getElementById('carousel-image');
            var tagContainer = document.getElementById('img-tag')

            if (imageElement) {
                imageElement.src = aboutImg[currentImageIndex];
                tagContainer.innerText = aboutImgTag[currentImageIndex]

                currentImageIndex++;

                if (currentImageIndex >= aboutImg.length) {
                    currentImageIndex = 0;
                }
            }
        }

        setInterval(changeImage, 5000);

        changeImage();
    </script>

    <?php require_once '../templates/footer.php' ?>
</body>
</html>