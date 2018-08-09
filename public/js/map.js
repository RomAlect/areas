var prevMarker = null; //use this variable to delete markers

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: {lat: 44.613873, lng: 33.3578383}
    });
    var geocoder = new google.maps.Geocoder();    

    $('#show_place_btn').bind('click', function () {
        geocodeLatLng(geocoder, map);
        hideFindPanel();
        clearFindPanel();
    });
    
    $('#find_place_btn').bind('click', function () {
        geocodeAddress(geocoder, map);
    });

    $('#address_to_find').bind("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            geocodeAddress(geocoder, map);
        }
    });
}

//Tries to find address using 'address' string
//If the address if found, sets marker on map and opens the 'Add' panel
function geocodeAddress(geocoder, resultsMap) {
    var address = $('#address_to_find').val();
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            removePreviousMarker();
            setMarkerOnMap(resultsMap, results);
            enableAddPanel(results[0].formatted_address, takeLat(prevMarker), takeLng(prevMarker));
        } else {
            showModal({
                modalTitle: 'Google Map',
                message: 'Geocode Service was not able to manage your request...',
                hideOk: true
            });
        }
    });
}

//Tries to find address using LatLng object
function geocodeLatLng(geocoder, resultsMap) {
    var city = $("#select_city option:selected");
    var latlng = {
        lat: parseFloat(city.data('lat')),
        lng: parseFloat(city.data('lng'))};
    if (prevMarker !== null) {
        prevMarker.setMap(null);
    }
    geocoder.geocode({'location': latlng}, function (results, status) {
        if (status === 'OK') {
            removePreviousMarker();
            setMarkerOnMap(resultsMap, results);
        } else {
            showModal({
                modalTitle: 'Google Map',
                message: 'Geocode Service was not able to manage your request...',
                hideOk: true
            });
        }
    });
}

//Sets the marker on the map using the result of the geocode search
function setMarkerOnMap(resultsMap, results) {
    resultsMap.setCenter(results[0].geometry.location);

    prevMarker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
    });

    var infoContent = takeInfo(
            results[0].formatted_address,
            takeLat(prevMarker),
            takeLng(prevMarker));

    var infoWindow = new google.maps.InfoWindow({
        content: infoContent,
        maxWidth: 350
    });

    prevMarker.addListener('click', function () {
        infoWindow.open(resultsMap, prevMarker);
    });

    resultsMap.setZoom(8);
}

function takeLat(marker) {
    return new Intl.NumberFormat('en-IN', {maximumFractionDigits: 6}).format(marker.position.lat());
}

function takeLng(marker) {
    return new Intl.NumberFormat('en-IN', {maximumFractionDigits: 6}).format(marker.position.lng());
}

//Removes previous marker from the map
function removePreviousMarker() {
    if (prevMarker !== null) {
        prevMarker.setMap(null);
    }
}

function enableAddPanel(address, latitude, longitude) { 
    $('#city_to_add').val(address);
    $('#lat').text(latitude);
    $('#lng').text(longitude);
    $('#add_panel').prop('hidden', false);
    $('#add_place_btn').prop('disabled', false);
}

function enableCRUD() {
    if ($('#select_city option:selected').val() !== "") {
        $('.crud').attr('disabled', false);
    } else {
        $('.crud').attr('disabled', true);
    }
    disableModifyPanel();
}

function enableFindPanel() {
    $('#add_btn').attr('hidden', true);
    $('#find_panel').attr('hidden', false);
}

function hideFindPanel() {
    $('#add_btn').attr('hidden', false);
    $('#find_panel').attr('hidden', true);
}

function clearFindPanel(){
    $('#address_to_find').val('');
    $('#add_place_btn').attr('disabled', true);
    $('#add_panel').attr('hidden', true);
}

function enableModifyPanel() {
    var place = $("#select_city option:selected").val();
    $('#modify_panel').attr('hidden', false);
    document.getElementById("new_city_name").value = place;
}

function disableModifyPanel() {
    $('#modify_panel').attr('hidden', true);

}

//Returns content for the Info Window
function takeInfo(address, lat, lng) {
    var infoWindowContent = '<div class="container">'
            + '<h5>' + address + '</h5><hr>'
            + '<div class="row d-flex justify-content-between mx-1">'
            + '<h6>lat:</h6>' + '<h6>' + lat + '</h6></div>'
            + '<div class="row d-flex justify-content-between mx-1">'
            + '<h6>lng:</h6>' + '<h6>' + lng + '</h6></div></div>';

    return infoWindowContent;
}
