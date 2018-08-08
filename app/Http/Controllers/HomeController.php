<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;


class HomeController extends Controller {

    //Renders the map page
    public function index() {
        $places = Place::orderBy('address')->get();
        return view('map', [  
            'places' => $places
        ]);
    }
}
