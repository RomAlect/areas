//-----------------Logic for Map service---------------------
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#new_city_name').bind("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        editPlace();
    }
});

function editPlace() {
    var route = $("#editRoute").html();
    var formerAddress = $("#select_city > option:selected").val();
    var newAddress = $("#new_city_name").val();

    $.ajax({
        method: "POST",
        url: route,
        data: {
            address: formerAddress,
            newAddress: newAddress
        },
        success: function (response) {
            fillCombobox(response);

            $('#select_city option').filter(function () {
                return ($(this).text() == newAddress);
            }).prop('selected', true);

            disableModifyPanel();

            showModal({
                modalTitle: 'Modify',
                message: 'Database successfully modified!',
                hideOk: true
            });

        }});
}

function deletePlace() {
    var route = $("#deleteRoute").html();
    var address = $("#select_city > option:selected").val();

    $.ajax({
        method: "POST",
        url: route,
        data: {
            address: address
        },
        success: function (response) {
            fillCombobox(response);
            $('.crud').attr('disabled', true);
        }
    });
}

function addPlace() {
    var route = $("#addRoute").html();
    var address = $("#city_to_add").val();
    var lat = $('#lat').html();
    var lng = $('#lng').html();

    $.ajax({
        method: "POST",
        url: route,
        data: {
            address: address,
            lat: lat,
            lng: lng
        },
        success: function (response) {
            if (response == 'Already exists') {
                showModal({
                    modalTitle: 'Add',
                    message: 'Such record already exists in the database!',
                    hideOk: true
                });
            } else {
                fillCombobox(response);
                $('.crud').attr('disabled', true);
//                $('#find_panel').attr('hidden',true);
//                $('#add_panel').attr('hidden',true);
//                $('#add_btn').attr('hidden',false);
                clearFindPanel();
                showModal({
                    modalTitle: 'Add',
                    message: 'The record "' + address + '" successfully added to the database!',
                    hideOk: true
                });
            }
        }
    });
}

function showModal(modalDetails) {
    $('#alert_dialog .modal-title').html(modalDetails.modalTitle);
    $('#alert_dialog .modal-body p').html(modalDetails.message);
    $('#ok_btn').prop('hidden', modalDetails.hideOk);
    $('#ok_btn').bind('click', modalDetails.okclick)
    $('#alert_dialog').modal();
}

function showDeleteModal() {
    var address = $("#select_city > option:selected").val();
    showModal({
        modalTitle: 'Delete',
        message: 'Are you sure you want to delete "' + address + '" from the database?',
        hideOk: false,
        okclick: deletePlace
    });
}

function fillCombobox(response) {
    var combobox = $('#select_city');
    combobox.empty();
    combobox.append($('<option>', {value: ''}).text('City...'));

    $.each(response, function (key, value) {
        combobox.append('<option data-lat="' + value.substring(0, value.indexOf("/") - 1)
                + '" data-lng="' + value.substring(value.indexOf("/") + 2) + '">'
                + key + '</option>');
    });
}


//-----------------Logic for Distances service---------------------

function loadDistances() {
    renderListHeader();
    var route = $("#calculateRoute").html();
    
    $.ajax({
        method: "GET",
        url: route,
        data: {
            address: $("#select_city > option:selected").val()
        },
        success: renderDistances
    });
}

function renderDistances(response) {
    var ul = $(".city-list ul");
            ul.empty();
            $.each(response, function (index, value) {
                var li = $('<li>');
                li.addClass('list-group-item d-flex justify-content-between align-items-center');
                li.append(index);
                var span = $('<span>');
                span.addClass('badge badge-primary badge-pill');
                span.append(value);
                li.append(span);
                ul.append(li);
            });
}

function renderListHeader() {

    if ($('#select_city > option:selected').val() !== "") {
        $("#listHeader span").remove();
        var span = $("<span>");
        span.addClass("badge badge-primary badge-pill");
        span.append("Distance, km");
        $("#listHeader li").append(span);        
    } else {
        $("#listHeader span").remove();
        var span = $("<span>");
        span.addClass("badge badge-primary badge-pill mr-4");        
        span.append("lat / lng");
        $("#listHeader li").append(span);
    }
}