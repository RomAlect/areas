<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\DistanceCalculator;

class DistanceController extends Controller {

    //Renders the distances page
    public function index() {
        $places = Place::orderBy('address')->get();

        return view('distances', [
            'places' => $places
        ]);
    }

    //Calculates distances between cities from the database. 
    //Results are written in the $distances array. Then this array is sorted with asort()
    //and is passed to the view
    public function calculate(Request $request) {
        
        $places = Place::orderBy('address')->get();
        
        if (!is_null($request['address'])) {            
            return DistanceCalculator::listNearest($places, $request['address']);
        }
        return DistanceCalculator::listAll($places);
    }
}
