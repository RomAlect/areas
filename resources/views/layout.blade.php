<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Find Place with Geocode</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/areas.css') }}">

    </head>
    <body>

        @yield('content')
        
        <div class="center-bar">
            <a class="btn btn-secondary mx-1 my-1" href="{{route('home')}}">Map</a>
            <a class="btn btn-info mx-1 my-1" href="{{route('distances')}}">Distances</a>
        </div>        

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="{{asset('js/map.js')}}"></script>
        @yield('googleMap')
    </body>
</html>
