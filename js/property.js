var start = 0
var end = 1

function displayRooms(rooms) {
    var roomsContainer = document.getElementById('rooms-container')

    var allRooms = ''
    for (var i = start; i <= end; i++) {
        var rID = rooms[i]['roomID'];
        var rName = rooms[i]['roomName'];
        var rDec = rooms[i]['roomDec'];
        var rImgURL = rooms[i]['imgURL'];
        var rPrice = rooms[i]['price'];
        var rChargingType = rooms[i]['chargingType'];

        var wifi = rooms[i]['wifi'];
        var tv = rooms[i]['tv'];
        var balcony = rooms[i]['balcony'];
        var privateBathroom = rooms[i]['privateBathroom'];
        var airCondition = rooms[i]['airCondition'];
        var fan = rooms[i]['fan'];
        var miniBar = rooms[i]['miniBar'];
        allRooms += `
            <a style='color: black;' href='./property.php?id=${rID}'>
            <div class='property-card'>
                
                <img class='room-card-img' src='${rImgURL}' alt='image of $ID'/>
                
                
                <div class='property-card-info'>
                    <div class='center-items'>
                        <div class='center-items' style='align-items: normal;flex-direction: column; gap: 2px;'>
                            <span style='font-weight:bold;'>${rName}</span>
                        </div>
                    </div>
                    <hr style='border: 0.5px solid rgb(0, 0, 0, 0.25);'/>
                    <div style='font-size: 14px; text-align: justify;'>
                        ${rDec}...
                    </div>
                    <hr style='border: 0.5px solid rgb(0, 0, 0, 0.25);'/>
                    <div class='center-items'>
                        <div>USD ${rPrice} / ${rChargingType}</div>
                        <div style='font-size: 14px;'>
                            <i class='fa-solid fa-water-ladder'></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        `
    }

    roomsContainer.innerHTML = allRooms
}

function prevRoom(rooms){
    if(start == rooms.length-1 || end == rooms.length-1){
        start = 0
        end = start + 1
        //alert(end)
    }else{
        start += 1
        end += 1
        //alert(end)
    }
    displayRooms(rooms)
}

function nextRoom(rooms){
    if(start == 0 || end == 0){
        start = 0
        end = start + 1
        //alert(end)
    }else{
        start -= 1
        end -= 1
        //alert(end)
    }
    displayRooms(rooms)
}

function handleRoomInput(){
    var roomList = document.getElementById('room-list')
    if(roomList.classList.contains('visible-type-list')){
        roomList.classList.remove('visible-type-list')
    }else{
        roomList.classList.add('visible-type-list')
    }
}

function roomItemClick(room, roomPrice){
    var roomElement = document.getElementById('room')
    var roomList = document.getElementById('room-list')
        
    localStorage.setItem('roomPrice', JSON.stringify(roomPrice))

    roomElement.value = `${room}`
    roomList.classList.remove('visible-type-list')
}

function booking(which){
    var detailsContainer = document.getElementById('hotel-details')
    var formContainer = document.getElementById('hotel-form')

    if(which == "details"){
        detailsContainer.classList.add('non-visible-booking')
        detailsContainer.classList.remove('visible-booking')
        formContainer.classList.remove('non-visible-booking')
        formContainer.classList.add('visible-booking')
    }if(which == 'form'){
        detailsContainer.classList.remove('non-visible-booking')
        detailsContainer.classList.add('visible-booking')
        formContainer.classList.remove('visible-booking')
        formContainer.classList.add('non-visible-booking')
    }
}