<section class="search">
    <script>
        function handleTypesInput(){
            var typesList = document.getElementById('type-list')
            if(typesList.classList.contains('visible-type-list')){
                typesList.classList.remove('visible-type-list')
            }else{
                typesList.classList.add('visible-type-list')
            }
        }
        
        function handleCityInput(){
            var typesList = document.getElementById('city-list')
            if(typesList.classList.contains('visible-type-list')){
                typesList.classList.remove('visible-type-list')
            }else{
                typesList.classList.add('visible-type-list')
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
        
        function cityItemClick(city){
            //alert(type);
            var cityElement = document.getElementById('where')
            var citiesList = document.getElementById('city-list')
            /*if(typeElement){
                alert(typeElement.value)
            }*/
            cityElement.value = `${city}`
            citiesList.classList.remove('visible-type-list')
        }
    </script>
    <?php
    $where = isset($_GET['where']) ? $_GET['where'] : '';
    $checkIn = isset($_GET['check-in']) ? $_GET['check-in'] : '';
    $checkOut = isset($_GET['check-out']) ? $_GET['check-out'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    ?>
    <form action="../pages/hotel-list.php" method="Get" class="center-items">
        <div class="center-items" style="gap: 40px; width:80%">
            <div style="position: relative; width: 50%;">
                <input 
                    name="where" 
                    id="where" 
                    style="width: 100%; border-bottom-left-radius: 5px; border-top-left-radius: 5px;" 
                    class="search" 
                    placeholder="Where are you going to?"
                    value="<?php echo htmlspecialchars($where); ?>"
                        
                />
                <i class="fa-solid fa-location-crosshairs search" ></i>
                <div class="type-list" id="city-list">
                    <?php
                    $getCityQuery = "SELECT * FROM towns";
                    $cities = $conn->query($getCityQuery);
                
                    while($row = $cities->fetch_assoc()) {
                        $cID = $row['townID'];
                        $cName = $row['townName'];
                        $dID = $row['districtID'];
                        echo "
                        <div class='type-item' onclick='cityItemClick(\"$cName\")'>
                            $cName
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>
            <script>{/*
            <div style="position: relative; width: 15%;">
                <input 
                    name="check-in" 
                    type="date" 
                    style="width: 100%; padding: 10.5px 30px;" 
                    class="search" 
                    placeholder="Check-in Date"
                    value="<?php echo htmlspecialchars($checkIn); ?>"
                />
                <i class="fa-regular fa-calendar search" ></i>
                
            </div>
            <div style="position: relative; width: 15%;">
                <input 
                    name="check-out" 
                    type="date" 
                    style="width: 100%; padding: 10.5px 30px;" 
                    class="search" 
                    placeholder="Check-out Date"
                    value="<?php echo htmlspecialchars($checkOut); ?>"
                />
                <i class="fa-regular fa-calendar search" ></i>
            </div>*/}
            </script>
            <div style="position: relative; width: 50%;">
                <input 
                    name="type" 
                    id="type" 
                    style="width: 100%; border-bottom-right-radius: 5px; border-top-right-radius: 5px; cursor: pointer; border-left:#0C8CE9 3px solid;" 
                    class="search" 
                    placeholder="Propert Type"
                    readonly
                    onclick='handleTypesInput()'
                    value="<?php echo htmlspecialchars($type); ?>"
                />
                <i class="fa-solid fa-hotel search" ></i>
                <div class="type-list" id="type-list">
                    <?php
                    $getTypesQuery = "SELECT * FROM categories";
                    $types = $conn->query($getTypesQuery);
                
                    while($row = $types->fetch_assoc()) {
                        $tID = $row['categoryID'];
                        $tName = $row['categoryName'];
                        $tURL = $row['categoryURL'];
                        echo "
                        <div class='type-item' onclick='typeItemClick(\"$tName\")'>
                            $tName
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="search">Search</button>
        </div>
    </form>
    
</section>