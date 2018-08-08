<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Infrastructure;

use Illuminate\Support\Collection;

/**
 * Description of DistanceCalculator
 *
 * @author Roman
 */
//Helper class allowing calculate distances between cities on the map
class DistanceCalculator {

    //Calculates distances between cities from the database. 
    //Results are written in the $distances associative array, where
    //'key' is address, and 'value' is the distance to this address from the selected city.
    //The $distances array is sorted on values with asort() and returned
    public static function listNearest(Collection $places, $address) {
        $from_place = $places->where('address', $address)->first();

        foreach ($places as $place) {
            if ($place->address !== $from_place->address) {

                $distances[$place->address] = self::calculateDistance($from_place->lat, $from_place->lng, $place->lat, $place->lng);
            }
        }
        asort($distances);
        return $distances;
    }
    
    //This method is used when the place is not selected.
    //Result is written in the $cities associative array, where
    //'key' is address, and 'value' is 'lat/lng' pair
    public static function listAll(Collection $places) {
        foreach ($places as $place) {
            $cities[$place->address] = round($place->lat, 6) . ' / ' . round($place->lng, 6);
        }
        return $cities;
    }

    //Calculates distance between two poins with Haversine formula
    private static function calculateDistance($from_lat, $from_lng, $to_lat, $to_lng) {
        return round(12742 * asin(
                        sqrt(
                                sin(deg2rad(($from_lat - $to_lat) / 2)) * sin(deg2rad(($from_lat - $to_lat) / 2)) +
                                cos(deg2rad($from_lat)) * cos(deg2rad($to_lat)) * sin(deg2rad(($from_lng - $to_lng) / 2)) * sin(deg2rad(($from_lng - $to_lng) / 2))
                        )
                ), 1);
    }

}
