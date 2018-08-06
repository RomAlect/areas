function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: {lat: 44.613873, lng: 33.3578383}
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('find_place').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
    });
    
    document.getElementById('show_place').addEventListener('click', function () {
        geocodeLatLng(geocoder, map);
    });

    document.getElementById('address').addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            geocodeAddress(geocoder, map);
        }
    });
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            var marker = setMarkerOnMap(resultsMap, results);
            var latitude = new Intl.NumberFormat('en-IN', {maximumFractionDigits: 6}).format(marker.position.lat());
            var longitude = new Intl.NumberFormat('en-IN', {maximumFractionDigits: 6}).format(marker.position.lng());
            var address = results[0].formatted_address;
            enableAddPanel(address, latitude, longitude);
        } else {
            jQuery('#mapAlert').modal();
        }
    });
}

function geocodeLatLng(geocoder, resultsMap){
    var city = jQuery("#select_city option:selected");
    var latlng = {
        lat: parseFloat(city.data('lat')), 
        lng:parseFloat(city.data('lng'))};
    geocoder.geocode({'location' : latlng}, function (results, status) {
        if (status === 'OK') {
            var marker = setMarkerOnMap(resultsMap, results);
        } else {
            jQuery('#mapAlert').modal();
        }
    });
}

function setMarkerOnMap(resultsMap, results) {
    resultsMap.setCenter(results[0].geometry.location);
    var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
    });
    resultsMap.setZoom(8);
    return marker;

    
//            marker.addListener('click', function () {
//                enableFindPanel()
//            });
}

function enableAddPanel(address, latitude, longitude) {
    jQuery('#cityToAdd').attr('value', address);
    jQuery('#lat').text(latitude);
    jQuery('#lng').text(longitude);
    jQuery('#add_panel').attr('hidden', false);
    jQuery('#add_place').attr('disabled', false);
}

function enableCRUD() {
    if (jQuery('#select_city option:selected').val() !== "") {
        jQuery('.crud').attr('disabled', false);
    } else {
        jQuery('.crud').attr('disabled', true);
    }
    disableModifyPanel();
}

function enableFindPanel() {
    jQuery('#add_btn').attr('hidden', true);
    jQuery('#find_panel').attr('hidden', false);
}

function disableFindPanel() {
    jQuery('#add_btn').attr('hidden', false);
    jQuery('#find_panel').attr('hidden', true);
}

function enableModifyPanel() {
    var place = jQuery("#select_city option:selected").val();
    jQuery('#modify_panel').attr('hidden', false);
    document.getElementById("modifiedCity").value = place;
    console.log($("#select_city option:selected").data("lat"));
}

function disableModifyPanel() {
    jQuery('#modify_panel').attr('hidden', true);

}


