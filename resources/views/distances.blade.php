@extends('layout')

@section('content')
<div id="calculateRoute" hidden>{{route('calculate')}}</div>
<div class="container">
    <div class="row">
        <div class="col-5"> 
            <label for="select_city" class="mt-2"><h2>Select your place:</h2></label> 
            <select class="form-control" id="select_city" name="address">
                <option value="">City...</option>
                @foreach($places as $place)
                <option>
                    {{$place->address}}
                </option>
                @endforeach
            </select>
            <br>
            <div class="row">
                <div class="col">
                    <h6 class="my-2 float-left">Find nearest places:</h6>
                </div>
                <div class="col">
                    <button class="btn btn-warning float-right" onclick="loadDistances()">Calculate</button>
                </div>
            </div>
        </div>

        <div class="col-7" >
            <ul id="listHeader" class="list-group mt-2">
                <li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white-50">
                    Address
                    <span class="badge badge-primary badge-pill mr-4">lat / lng</span>
                </li>
            </ul>
            <div class="city-list">
                <ul class="list-group">
                    @if(isset($places))
                    @foreach($places as $place)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {!!$place->address!!}
                        <span class="badge badge-primary badge-pill">{{round($place->lat,6)}} / {{round($place->lng,6)}}</span>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
