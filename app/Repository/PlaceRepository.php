<?php

namespace App\Repository;

use App\Repository\PlaceRepositoriable;
use App\Place;

class PlaceRepository implements PlaceRepositoriable {

    public function getPlaceCollection($order = 'asc') {
       return Place::orderBy('address', $order)->get();
    }

    public function getPlace($address = null, $lat = null, $lng = null) {
        return Place::where('address', $address)
                        ->orWhere([['lat', '=', $lat], ['lng', '=', $lng]])
                        ->first();
    }

    //Returns 'Success', if the place succesfully added
    //Otherwise returns 'Already exists'
    public function addPlace($address, $lat, $lng) {
        $cities = Place::where('address', $address)
                ->orWhere([['lat', '=', $lat], ['lng', '=', $lng]])
                ->get();
        if ($cities->count() === 0) {
            $place = new Place();
            $place->address = $address;
            $place->lat = $lat;
            $place->lng = $lng;
            $place->save();

            return 'Success';
        } else {
            return 'Already exists';
        }
    }

    public function deletePlace($address) {
        Place::where('address', $address)->delete();
    }

    public function editPlace($address, $newAddress) {
        Place::where('address', $address)
                ->update(['address' => $newAddress]);
    }

}
