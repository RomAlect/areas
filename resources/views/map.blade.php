@extends('layout')

@section('content')
<div class="card left-bar">
    <div class="card-header font-weight-bold">Select the place</div>
    <form class="form-inline">                            
        <select class="form-control" id="select_city" name="address" onchange="enableCRUD()">
            <option value="">City...</option>
            @foreach($places as $place)
            <option>
                {{$place->address}}
            </option>
            @endforeach
        </select>
        <button id="showOnMap" class="btn btn-secondary ml-2 my-2 crud" disabled>Show</button>
    </form>
    <div class="container">
        <div class="row d-flex ">
            <button class="btn btn-warning mr-1 flex-fill crud" disabled>Modify</button>            
            <button class="btn btn-danger ml-1 flex-fill crud" disabled>Delete</button>
        </div>   
        <div class="row d-flex ">
            <button id="add_btn" class="btn btn-primary flex-fill mt-2">Add</button>
        </div>
    </div>
    <!--Start: Find the place with GeoCode-->
    <div class="card-header font-weight-bold" hidden>Find the place</div>
    <form class="form-inline" hidden>                            
        <label for="address" class="mx-2 my-2 font-weight-bold">City/Place</label>                
        <input id="address" type="textbox" value="" class="form-control mx-2 my-2">
        <input id="submit" type="button" class="btn btn-secondary mx-2 my-2" value="Find">
    </form>
    <!--Finish: Find the place with GeoCode-->

    <div class="modal-header bg-warning hidden" {{ ($isSaved === true || $isExist === true)? '' : 'hidden' }}>
         <h5 class="modal-title font-weight-bold  text-body">Add the place</h5>
        <button type="button" class="close" onclick="hideAddForm()">&times;</button>
    </div>
    <form style="background-color: #fff" class="pb-1 hidden" {{ ($isSaved === true || $isExist === true)? '' : 'hidden' }} method="post" action="{{route('add')}}">
          @csrf

          <p id="cityToAdd" class="mx-2 my-2 font-weight-bold">{{(isset($address)) ? $address : ''}}</p>
        <div class="float-left">
            <kbd class="mx-2 ">lat:</kbd><span id="lat" class="mx-2">{{(isset($lat)) ? $lat : ''}}</span><br>
            <kbd class="mx-2 ">long:</kbd><span id="lng" class="mx-2">{{(isset($lng)) ? $lng : ''}}</span>
        </div>

        <input type="submit" class="btn btn-warning float-right mx-2 mt-2" value="Add" 
               {{ ($isSaved === true || $isExist === true)? 'disabled' : '' }}><br><br>


        <div id="isSaved" class="text-right align-bottom text-success mx-2 mt-2" {{ ($isSaved === false)? 'hidden' : '' }}>Successfully saved</div>
        <div id="isExist" class="text-right align-bottom text-warning mx-2" {{ ($isExist === false)? 'hidden' : '' }}>Already in the base</div>

        <input type="text" name="lat" hidden="true">
        <input type="text" name="lng" hidden="true" >
        <input type="text" name="address" hidden="true" >

    </form>

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