<?php

namespace App\Repository;

interface PlaceRepositoriable {

    public function getPlaceCollection($order);

    public function getPlace($address, $lat, $lng);

    public function addPlace($address, $lat, $lng);

    public function deletePlace($address);

    public function editPlace($address, $newAddress);
}
