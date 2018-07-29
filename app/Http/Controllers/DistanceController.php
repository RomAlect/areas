<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

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
            $from_place = $places->where('address', $request['address'])->first();

            foreach ($places as $place) {
                if ($place->address !== $from_place->address) {

                    $distances[$place->address] = $this->calculateDistance($from_place->lat, $from_place->lng, $place->lat, $place->lng);
                }
            }
            
            asort($distances);

            return view('distances', [
                'places' => $places,
                'distances' => $distances,
                'selected_city' => $request['address']
            ]);
        }
        return view('distances', [
            'places' => $places
        ]);
    }

    //Calculates distance between two poins with Haversine formula
    public function calculateDistance($from_lat, $from_lng, $to_lat, $to_lng) {
        return round(12742 * asin(
                        sqrt(
                                sin(deg2rad(($from_lat - $to_lat) / 2)) * sin(deg2rad(($from_lat - $to_lat) / 2)) +
                                cos(deg2rad($from_lat)) * cos(deg2rad($to_lat)) * sin(deg2rad(($from_lng - $to_lng) / 2)) * sin(deg2rad(($from_lng - $to_lng) / 2))
                        )
                ), 1);
    }

}
