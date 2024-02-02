var currentIndex = 0;
var start = 0
var end = 4

function displayTypes(types) {
    var typesContainer = document.getElementById('types-container')

    var allTypes = ''
    for (var i = start; i <= end; i++) {
        var tID = types[i]['categoryID'];
        var tName = types[i]['categoryName'];
        var tURL = types[i]['categoryURL'];
        allTypes += `
            <div>
                <img class='types' src='${tURL}' alt='image of ${tName}'/>
                <div>${tName}</div>
            </div>
        `
    }

    typesContainer.innerHTML = allTypes
}

function prev(types){
    if(start == types.length-1 || end == types.length-1){
        start = 0
        end = start + 4
        //alert(end)
    }else{
        start += 1
        end += 1
        //alert(end)
    }
    displayTypes(types)
}

function next(types){
    if(start == 0 || end == 0){
        start = 0
        end = start + 4
        //alert(end)
    }else{
        start -= 1
        end -= 1
        //alert(end)
    }
    displayTypes(types)
}

var locationName = ['Colombo', 'Kandy', 'Ella', 'Mirissa', 'Nuwara Eliya', 'Trincomalee', 'Unawatuna', 'Yala', 'Anuradhapura', 'Negombo']
var locationImg = [
    'https://cf.bstatic.com/xdata/images/city/600x600/685293.jpg?k=799ffc96a5a78c6ed25a9f622dd64617e54e27219c54a828d1830cb3055560db&o=',
    'https://cf.bstatic.com/xdata/images/city/600x600/685330.jpg?k=ee4ac422e47649d2d04a9759dc81fa51f138f477796a8043557e864517ae6f5f&o=',
    'https://cf.bstatic.com/xdata/images/city/600x600/685291.jpg?k=df198931295a3a24c278b32556c0779cd74e95a239489a7fe98d89eb2aed72ee&o=',
    'https://cf.bstatic.com/xdata/images/city/600x600/685322.jpg?k=e29ccaeca3576b692e39f01d613b237ad0dd03a2a886b62db77c11b8dd3379ce&o=',
    'https://cf.bstatic.com/xdata/images/city/600x600/685389.jpg?k=b2ee6ea5ea52888fac4782d1c7959f9aa2572f382ff25a06418b53e735c71e80&o=',
    'https://www.holidify.com/images/cmsuploads/compressed/1280px-Coral_Cove_Beach_Trincomalee_20200108140434.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXUbAoxqXXgZ82WNfkBMyGIPcppItJIUApzRXmJaASY0gg4NYP1LlktHdDtfmIaoC67kc&usqp=CAU',
    'https://www.holidify.com/images/cmsuploads/compressed/YALA-NATIONAL-PARK_20190718152819.jpg',
    'https://www.trawell.in/admin/images/upload/067693590Anuradhapura_Main.jpg',
    'https://content.r9cdn.net/rimg/dimg/16/71/1bacba85-city-46478-169110981a8.jpg?width=1366&height=768&xhint=1958&yhint=842&crop=true'
]

var locationDec = [
    "Colombo, the vibrant capital of Sri Lanka, beckons with its blend of modernity and rich history. Explore bustling markets, savor delectable cuisine, and marvel at colonial architecture amidst a tapestry of cultural diversity.",
    "Uncover the cultural heart of Sri Lanka in Kandy, where ancient traditions meet scenic beauty. Immerse in vibrant markets, savor local delicacies, and explore historical sites, creating a tapestry of unforgettable experiences.",
    "Ella, a tranquil hillside gem, invites you to discover serenity amidst breathtaking landscapes. Hike to iconic viewpoints, indulge in local flavors, and absorb the laid-back charm that defines this enchanting destination.",
    "Mirissa, a coastal haven, beckons with sun-kissed beaches and vibrant marine life. Dive into its lively atmosphere, savor fresh seafood, and unwind by the ocean, creating blissful memories in this tropical paradise.",
    "In Nuwara Eliya, the 'Little England' of Sri Lanka, embrace colonial elegance amid lush tea plantations. Explore scenic gardens, savor aromatic teas, and bask in the cool climate, capturing the essence of this charming hill station.",
    "Trincomalee, a coastal jewel, invites you to pristine beaches and ancient temples. Dive into clear waters, savor local seafood delights, and explore historical landmarks, creating a harmonious blend of relaxation and cultural exploration.",
    "Unawatuna, a coastal haven, captivates with golden shores and vibrant nightlife. Immerse in beach activities, relish diverse cuisine, and experience the lively ambiance, making it an ideal destination for sun-seekers.",
    "Discover the wild beauty of Yala, where national parks teem with diverse wildlife. Embark on thrilling safaris, connect with nature, and relish the unique experience of encountering untamed wonders in this natural sanctuary.",
    "Step into the ancient kingdom of Anuradhapura, where sacred ruins echo tales of a bygone era. Explore historic landmarks, witness religious ceremonies, and immerse in the spiritual ambiance of this UNESCO-listed city.",
    "Negombo, a coastal town with a rich history, invites you to explore its vibrant markets and sandy shores. Savor fresh seafood, witness cultural diversity, and unwind in this charming destination where tradition meets modernity."
]

var startLocation = 0
var endLocation = 3

function displayLocations() {
    var locationsContainer = document.getElementById('locations-container')

    var allLocation = ''
    for (var i = startLocation; i <= endLocation; i++) {
        var lName = locationName[i]
        var lURL = locationImg[i]
        var lDec = locationDec[i]
        allLocation += `
            <div class='location-container'>
                <a href='../pages/hotel-list.php?where=${lName}' style='color: black;'>
                <img class='location' src='${lURL}' alt='image of ${lName}'/>
                <div class='location'>
                    <div style='font-size: 20px; font-weight: 700;'>${lName}</div>
                    <div style='font-size:14px; margin-top: 10px;'>${lDec}</div>
                </div>
                </a>
            </div>
        `
    }

    locationsContainer.innerHTML = allLocation
}

function prevLocation(){
    if(startLocation == locationName.length-1 || endLocation == locationName.length-1){
        startLocation = 0
        endLocation = start + 3
        //alert(end)
    }else{
        startLocation += 1
        endLocation += 1
        //alert(end)
    }
    displayLocations()
}

function nextLocation(){
    if(startLocation == 0 || endLocation == 0){
        startLocation = 0
        endLocation = start + 3
        //alert(end)
    }else{
        startLocation -= 1
        endLocation -= 1
        //alert(end)
    }
    displayLocations()
}

var startHotel = 0
var endHotel = 0

function displayHotels(hotels) {
    var hotelsContainer = document.getElementById('hotels-container')

    var allHotels = ''
    for (var i = startHotel; i <= endHotel; i++) {
        var hID = hotels[i]['hotelID'];
        var hName = hotels[i]['hotelName'];
        var hImg = hotels[i]['coverURL'];
        var hDescription = hotels[i]['description'];
        var address = hotels[i]['address'];
        //var hImg = hotels[i]['categoryURL'];

        var words = hDescription.split(/\s+/)
        var shortDescription = words.slice(0, 25).join(' ')

        allHotels += `
        <a style='color: black;' href='./property.php?id=${hID}'>
        <div class='property-card'>
            
            <img class='property-card-img' src='${hImg}' alt='image of $ID'/>
            
            
            <div class='property-card-info'>
                <div class='center-items'>
                    <div class='center-items' style='align-items: normal;flex-direction: column; gap: 2px;'>
                        <span>${hName}</span>
                        <span style='font-size: 12px;'><i class='fa-solid fa-location-dot'></i> ${address}</span>
                    </div>
                    <div style='background-color: #0C8CE9; width: 25px; height: 25px; border-radius: 5px;'>
                    </div>
                </div>
                <hr style='border: 0.5px solid rgb(0, 0, 0, 0.25);'/>
                <div style='font-size: 14px; text-align: justify;'>
                    ${shortDescription}...
                </div>
                
            </div>
        </div>
        </a>
        `
    }

    hotelsContainer.innerHTML = allHotels
}

function prevHotel(hotels){
    if(startHotel == hotels.length-1 || endHotel == hotels.length-1){
        startHotel = 0
        endHotel = start + 4
        //alert(end)
    }else{
        startHotel += 1
        endHotel += 1
        //alert(end)
    }
    displayHotels(hotels)
}

function nextHotel(hotels){
    if(startHotel == 0 || end == 0){
        startHotel = 0
        endHotel = start + 4
        //alert(end)
    }else{
        startHotel -= 1
        endHotel -= 1
        //alert(end)
    }
    displayHotels(hotels)
}
