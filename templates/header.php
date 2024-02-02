<header class="header">
    <script>
        function handleMenu(){
            var typesList = document.getElementById('menu')
            if(typesList.classList.contains('menu-container-visible')){
                typesList.classList.remove('menu-container-visible')
            }else{
                typesList.classList.add('menu-container-visible')
            }
        }

        function typeItemClick(type){
            //alert(type);
            var typeElement = document.getElementById('type')
            var typesList = document.getElementById('type-list')
            /*if(typeElement){
                alert(typeElement.value)
            }*/
            typeElement.value = `${type}`
            typesList.classList.remove('visible-type-list')
        }
    </script>
    <div class="center-items" style="gap: 10px;">
        <img class="logo" src="../assets/logo.png" alt="logo"/>
        <span class="brand-name">CeylonComforts</span>
    </div>
    <div class="center-items" style="gap: 20px;">
        <a class="header" href="../pages/home.php"><span class="nav-item">Home</span></a>
        <a class="header" href="../pages/hotel-list.php?where=&type="><span class="nav-item">Properties</span></a>
        <a class="header" href=""><span class="nav-item">Offers</span></a>
        <a class="header" href=""><span class="nav-item">Help and Support</span></a>
    </div>
    <?php
    if(isset($_SESSION['userID'])){
        $userID = $_SESSION['userID'];
        $query = "SELECT firstname, lastname FROM users WHERE userID='$userID'";
        $result = $conn->query($query);
        $firstname;
        $lastname;

        while($row = $result->fetch_assoc()){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }

        echo "<div class='center-items' style='gap: 20px;'>
                <span onclick='handleMenu()' style='cursor:pointer;'>$firstname $lastname</span>
                <span onclick='handleMenu()' class='profile-img'>S</span>
            </div>";
    }else{
        echo "<div style='gap: 20px;'>
                <a href='../pages/signin.php'>
                    <button class='primary'>Sign In</button>
                </a>
                <a href='../pages/signup.php'>
                    <button class='primary'>Sign Up</button>
                </a>
                
            </div>";
    }
    ?>
    <div class="menu-container" id="menu">
        <span class="menu-item"><a class="menu-item" href="../pages/profile.php">Persional Info</a></span>
        <span class="menu-item"><a class="menu-item" href="../pages/my-bookings.php">Bookings</a></span>
        <span class="menu-item">Test</span>
        <form action="../scripts/logout-process.php">
            <button type="submit" class='primary'>Log out</button>
        </form>
        
    </div>
</header>
