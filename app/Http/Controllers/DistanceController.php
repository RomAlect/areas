<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Infrastructure\DistanceCalculator;

class DistanceController extends Controller {

    //Renders the distances page
    public function index() {
        $places = Place::orderBy('address')->get();

        return view('distances', [
            'places' => $places
        ]);
    }

    //Uses AJAX GET request.
    //If the request contains 'address' property Returns an associative array
    public function calculate(Request $request) {
        
        $places = Place::orderBy('address')->get();
        
        if (!is_null($request['address'])) {            
            return DistanceCalculator::listNearest($places, $request['address']);
        }
        return DistanceCalculator::listAll($places);
    }
}
