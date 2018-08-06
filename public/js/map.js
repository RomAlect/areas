function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: {lat: 44.613873, lng: 33.3578383}
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('submit').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
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
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
            var latitude = new Intl.NumberFormat('en-IN', {maximumFractionDigits: 6}).format(marker.position.lat());
            var longitude = new Intl.NumberFormat('en-IN', {maximumFractionDigits: 6}).format(marker.position.lng());
            var address = results[0].formatted_address;

            showAddForm(address, latitude, longitude);
            marker.addListener('click', function () {
                showAddForm(address, latitude, longitude)
            });
            resultsMap.setZoom(8);
        } else {
            jQuery('#mapAlert').modal();
        }
    });
}

function hideAddForm() {
    jQuery('.hidden').attr('hidden', true);
}

function showAddForm(address, latitude, longitude) {
    jQuery('.hidden').attr('hidden', false);
    jQuery('#cityToAdd').text(address);
    jQuery('#lat').text(latitude);
    jQuery('#lng').text(longitude);
    jQuery('form input[name="lat"]').attr('value', latitude);
    jQuery('form input[name="lng"]').attr('value', longitude);
    jQuery('form input[name="address"]').attr('value', address);
    jQuery('form input[type="submit"]').attr('disabled', false);
    jQuery('#isSaved, #isExist').attr('hidden', true);
}

function enableCRUD(){
    if(jQuery('#select_city option:selected').val() !== ""){
    jQuery('.crud').attr('disabled', false);
    }
    else{
        jQuery('.crud').attr('disabled', true);
    }
}


