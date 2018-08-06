<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Support\Collection;

/**
 * Description of DistanceCalculator
 *
 * @author Roman
 */
class DistanceCalculator {

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

    public static function listAll(Collection $places) {
        foreach ($places as $place) {
            $cities[$place->address] = round($place->lat,3) . ' / ' . round($place->lng,3);
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
