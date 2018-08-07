@extends('layout')

@section('content')
<div id="editRoute" hidden>{{route('edit')}}</div>
<div class="card left-bar">

    <!--Start: 'Select place' panel-->
    <div class="container">
        <div class="card-header font-weight-bold row mb-2">Select place</div>
        <div class="row d-flex mb-2">  
            <select class="controller flex-fill mr-1" id="select_city" onchange="enableCRUD()">
                <option value="">City...</option>
                @foreach($places as $place)
                <option data-lat='{{$place->lat}}' data-lng='{{$place->lng}}'>
                    {{$place->address}}
                </option>
                @endforeach
            </select>
            <button id="show_place_btn" class="btn btn-secondary flex-fill ml-1 crud" disabled>Show</button>  
        </div>        
        <div class="row d-flex">
            <button class="btn btn-warning flex-fill mr-1 crud" disabled onclick="enableModifyPanel()">Modify</button>            
            <button class="btn btn-danger flex-fill ml-1 crud" disabled>Delete</button>
        </div>

    </div>    
    <!--Finish: 'Select place' panel-->

    <!--Start: 'Modify place' panel-->
    <div class="container">
        <div id="modify_panel" hidden>
            <div class="modal-header bg-warning row mt-4">
                <h5 class="modal-title font-weight-bold" style="color: #fff">Modify place</h5>
                <button class="close" style="color: #fff" onclick="disableModifyPanel()">&times;</button>
            </div>
            <div class="row d-flex">
                <input type="text" id="new_city_name" class="font-weight-bold flex-fill controller">
            </div>
            <div class="row d-flex">
                <button class="btn btn-warning flex-fill mt-1" onclick="editPlace()">Confirm changes</button>
            </div>
        </div>
    </div>
    <!--Finish: 'Modify place' panel-->

    <!--Start: 'Find place' panel-->

    <div class="container">
        <div class="row d-flex">
            <button id="add_btn" class="btn btn-primary flex-fill mt-4" onclick="enableFindPanel()">Add place...</button>
        </div>

        <div id="find_panel" hidden>

            <div class="modal-header bg-primary row mt-4">
                <h5 class="modal-title font-weight-bold" style="color: #fff">Find place</h5>
                <button type="button" class="close" style="color: #fff" onclick="disableFindPanel()">&times;</button>
            </div>

            <div class="row d-flex mt-2">
                <label for="address" class="font-weight-bold flex-fill white-label justify-content-center mr-1">City/Place</label>                
                <input id="address" type="text" class="controller flex-fill ml-1">
            </div>
            <div id="add_panel" hidden>
                <div class="row d-flex mt-2">
                    <input type="text" id="cityToAdd" class="font-weight-bold flex-fill controller">
                </div>

                <div class="row d-flex justify-content-between py-1 px-1" style="background-color: #fff">
                    <kbd>lat:</kbd>
                    <h6 id="lat" class="mr-1"></h6>                    
                </div>
                <div class="row d-flex justify-content-between py-1 px-1" style="background-color: #fff">
                    <kbd>lng:</kbd>
                    <h6 id="lng" class="mr-1"></h6>                    
                </div>
            </div>

            <div class="row d-flex mt-2">
                <button id="add_place" class="btn btn-success flex-fill mr-1" onclick="" disabled>Add</button>
                <button id="find_place_btn" class="btn btn-primary flex-fill ml-1">Find</button>
            </div>
        </div>
    </div>
    <!--Finish: 'Find place' panel-->
</div>

<div id="map"></div>

<!--Modal alert-->
<div class="modal fade" id="mapAlert">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Oops!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="font-weight-bold text-center">Geocode Service was not able to manage your request...</p>
                <p class="font-weight-bold text-center">Check the City/Place input</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('googleMap')
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback&callback=initMap&language=en">
</script>
@endsection