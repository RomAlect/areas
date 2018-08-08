<?php

namespace App\Repository;

interface PlaceRepositoriable {

    public function getPlaceList();

    public function getPlace($address);

    public function addPlace($address);

    public function deletePlace($address);

    public function editPlace($address);
}
