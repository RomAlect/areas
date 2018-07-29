@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-5">                       
            <form method="post" action="{{route('calculate')}}">
                @csrf
                <label for="select_city" class="mt-2"><h2>Select your city:</h2></label> 
                <select class="form-control" id="select_city" name="address">
                    <option value="">City...</option>
                    @foreach($places as $place)
                    
                    <option {{(isset($selected_city)&& $selected_city == $place->address) ? 'selected' : ''}}>
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
                        <input type="submit" class="btn btn-warning float-right" value="Calculate">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-7" >
            <ul class="list-group mt-2">
                <li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-white-50">
                    Address
                    {!!isset($distances)? '<span class="badge badge-primary badge-pill">Distance, km</span>' : 
                    '<span class="badge badge-primary badge-pill mr-5">lat / lng</span>'!!}
                </li>
            </ul>
            <div class="city-list">
                <ul class="list-group">
                   @if(isset($distances))
                   @foreach($distances as $address => $distance)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {!!$address!!}
                        <span class="badge badge-primary badge-pill">{{$distance}}</span>
                    </li>                    
                    @endforeach
                                        
                    @else
                    @foreach($places as $place)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {!!$place->address!!}
                        <span class="badge badge-primary badge-pill">{{round($place->lat,3)}} / {{round($place->lng,3)}}</span>
                    </li>
                    
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection