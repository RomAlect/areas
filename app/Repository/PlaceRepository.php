<?php

namespace App\Repository;

use App\Repository\PlaceRepositoriable;
use App\Place;

class PlaceRepository extends PlaceRepositoriable {

    public function getPlaceList($order = 'asc') {
        if ($order === 'desc') {
            return Place::orderBy('address', 'desc')->get();
        } else {
            return Place::orderBy('address')->get();
        }
    }

    public function getPlace($address){
        return Place::where('address', $address)->first();
    }

    public function addPlace($address){
        
    }

    public function deletePlace($address){
        
    }

    public function editPlace($address){
        
    }
}
