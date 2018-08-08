<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Infrastructure\DistanceCalculator;
use App\Repository\PlaceRepositoriable;

class DistanceController extends Controller {
    
    private $rep;

    public function __construct(PlaceRepositoriable $rep) {
        $this->rep = $rep;
    }

    //Renders the distances page
    public function index() {
        $places = $this->rep->getPlaceCollection();

        return view('distances', [
            'places' => $places
        ]);
    }

    //Uses AJAX GET request.
    //If the request contains 'address' property Returns an associative array
    public function calculate(Request $request) {
        
        $places = $this->rep->getPlaceCollection();
        
        if (!is_null($request['address'])) {            
            return DistanceCalculator::listNearest($places, $request['address']);
        }
        
        return DistanceCalculator::listAll($places);
    }
}
