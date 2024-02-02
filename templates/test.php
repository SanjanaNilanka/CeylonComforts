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
        
        function handleCityInput() {
            var input, filter, cityList, cityItems, city, i;
            input = document.getElementById('where');
            filter = input.value.toUpperCase();
            cityList = document.getElementById('city-list');
            cityItems = cityList.getElementById('type-item');

            for (i = 0; i < cityItems.length; i++) {
                city = cityItems[i];
                if (city.textContent.toUpperCase().indexOf(filter) > -1) {
                    city.style.display = '';
                } else {
                    city.style.display = 'none';
                }
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
        
        function cityItemClick(city) {
    var cityElement = document.getElementById('where');
    var cityList = document.getElementById('city-list');
    
    cityElement.value = city;
    cityList.classList.remove('visible-type-list');
}
    </script>
    <?php
    $where = isset($_GET['where']) ? $_GET['where'] : '';
    $checkIn = isset($_GET['check-in']) ? $_GET['check-in'] : '';
    $checkOut = isset($_GET['check-out']) ? $_GET['check-out'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    ?>
    <form action="../pages/hotel-list.php" method="Get" class="center-items">
        <div class="center-items" style="gap: 40px;">
            <div style="position: relative; width: 25%;">
            <input 
                name="where" 
                id="where" 
                style="width: 100%; border-bottom-left-radius: 5px; border-top-left-radius: 5px;" 
                class="search" 
                placeholder="Where are you going to?"
                value="<?php echo htmlspecialchars($where); ?>"
                oninput='handleCityInput()'
            />
            <i class="fa-solid fa-location-crosshairs search"></i>
            <div class="type-list" id="city-list">
                <?php
                $getCityQuery = "SELECT * FROM towns";
                $cities = $conn->query($getCityQuery);

                while($row = $cities->fetch_assoc()) {
                    $cID = $row['townID'];
                    $cName = $row['townName'];
                    $dID = $row['districtID'];
                    echo "
                    <div class='type-item' id='type-item' onclick='cityItemClick(\"$cName\")'>
                        $cName
                    </div>
                    ";
                }
                ?>
                </div>
            </div>
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
            </div>
            <div style="position: relative; width: 25%;">
                <input 
                    name="type" 
                    id="type" 
                    style="width: 100%; border-bottom-right-radius: 5px; border-top-right-radius: 5px; cursor: pointer;" 
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