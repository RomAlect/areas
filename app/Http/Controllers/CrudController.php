<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Infrastructure\DistanceCalculator;

class CrudController extends Controller {

    public function edit(Request $request) {

        try {
            Place::where('address', $request['address'])
                    ->update(['address' => $request['newAddress']]);
            $places = Place::orderBy('address')->get();
        } catch (Exception $e) {
            //TODO
        }
        return DistanceCalculator::listAll($places);
    }

    public function delete(Request $request) {
        try {
            Place::where('address', $request['address'])->delete();
            $places = Place::orderBy('address')->get();
        } catch (Exception $e) {
            //TODO
        }
        return DistanceCalculator::listAll($places);
    }

    public function add(Request $request) {
        $cities = Place::where('address', $request['address'])
                ->orWhere([
                    ['lat','=',$request['lat']],
                    ['lng','=',$request['lng']]
                    ])->get();
        if ($cities->count() === 0) {
            $place = new Place();
            $place->address = $request['address'];
            $place->lat = $request['lat'];
            $place->lng = $request['lng'];
            $place->save();
            $places = Place::orderBy('address')->get();
            return DistanceCalculator::listAll($places);
        } else {
            return 'Already exists';
        }
    }

}
