<?php

namespace App\Http\Controllers;

use App\Repository\PlaceRepositoriable;

class HomeController extends Controller {

    private $rep;

    public function __construct(PlaceRepositoriable $rep) {
        $this->rep = $rep;
    }

    //Renders the map page
    public function index() {
        $places = $this->rep->getPlaceCollection();
        return view('map', [
            'places' => $places
        ]);
    }

}
