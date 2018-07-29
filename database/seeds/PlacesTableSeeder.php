<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        $areas = require(public_path().'/areas.php');

        foreach ($areas as $k => $v) {
            DB::table('places')->insert([
                'address' => $k,
                'lat' => $v['lat'],
                'lng' => $v['long']
            ]);
        }
    }

}
