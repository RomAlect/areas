<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Infrastructure\DistanceCalculator;
use App\Repository\PlaceRepositoriable;

class CrudController extends Controller {

    private $rep;

    public function __construct(PlaceRepositoriable $rep) {
        $this->rep = $rep;
    }

    public function edit(Request $request) {

        $this->rep->editPlace($request['address'], $request['newAddress']);

        return DistanceCalculator::listAll($this->rep->getPlaceCollection());
    }

    public function delete(Request $request) {
        $this->rep->deletePlace($request['address']);

        return DistanceCalculator::listAll($this->rep->getPlaceCollection());
    }

    public function add(Request $request) {
        $status = $this->rep->addPlace(
                $request['address'], $request['lat'], $request['lng']
        );
        if($status == 'Success'){
            return DistanceCalculator::listAll($this->rep->getPlaceCollection());
        } else {
            return $status;
        }
    }

}
