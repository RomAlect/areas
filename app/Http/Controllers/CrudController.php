<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\DistanceCalculator;

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

}
