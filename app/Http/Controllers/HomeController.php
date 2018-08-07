<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\DistanceCalculator;


class HomeController extends Controller {

    //Renders the map page
    public function index() {
        $places = Place::orderBy('address')->get();
        return view('map', [  
            'places' => $places,
            'isSaved' => false, //is used to show/hide 
            'isExist' => false  //the status messages
        ]);
    }

    //Defined the logic of adding the city to the database
    public function add(Request $request) {
        $cities = Place::where('address',$request['address'])->get();
        $isSaved = false;
        $isExist = false;
        if($cities->count() === 0){
            $place = new Place();
            $place->address = $request['address'];
            $place->lat = $request['lat'];
            $place->lng = $request['lng'];
            $place->save();
            $isSaved = true;
        } else{
            $isExist = true;
        }
        
        return view('map', [
            'isSaved' => $isSaved,
            'isExist' => $isExist,
            'address' => $request['address'],
            'lat' => $request['lat'],
            'lng' => $request['lng']
        ]);
        
    }
    
    public function edit(Request $request){
        
        try{
        $place = Place::where('address', $request['address'])->first();
        $place->address = $request['newAddress'];
        $place->save();
        
        
            $places = Place::orderBy('address')->get();     
        }
        catch(Exception $e){
            return [];
        }
         
        return DistanceCalculator::listAll($places);
        
    }

}
