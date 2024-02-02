<footer class="footer">
    <div class="center-items">
        <div>
            <span class="brand-name">CeylonComforts</span>
            <br/>
            <br/>
            <div class="center-items" style="gap: 15px; width: 50%;">
                <i style="font-size: 30px; cursor: pointer;" class="fa-brands fa-square-facebook"></i>
                <i style="font-size: 30px; cursor: pointer;" class="fa-brands fa-square-instagram"></i>
                <i style="font-size: 30px; cursor: pointer;" class="fa-brands fa-square-x-twitter"></i>
                <i style="font-size: 30px; cursor: pointer;" class="fa-brands fa-linkedin"></i>
                <i style="font-size: 30px; cursor: pointer;" class="fa-brands fa-square-whatsapp"></i>
            </div>
            <br/>
            <div class="center-items" style="flex-direction: column; align-items: start; gap: 2px;">
                <span>Call: (+94) 769276950</span>
                <span>email: info@ceyloncomforts.com</span>
                <span>Listing: listing@ceyloncomfort.com</span>
            </div>
        </div>
            
        <div class="center-items" style="flex-direction: column; align-items: start; gap: 15px;">
            <span>Home</span>
            <span>Hotels</span>
            <span>Offers</span>
            <span>About Us</span>
            <span>Help & Support</span>
        </div>

        

        <div class="center-items" style="flex-direction: column; align-items: normal; gap: 18px;">
            <?php
            if(!isset($_SESSION['userID'])){
                echo "
                <button class='footer'>Sign in</button>
                <button class='footer'>Sign up</button>
                ";
            }
            ?>
            <button class="footer">List Your Property</button>
        </div>   
    </div>
    <br/>
    <hr/>
    <div style="text-align: center; margin-top: 30px;">
    Copyrights © 2024 CeylonComforts™. All Rights Reserved.
    </div>
</footer>