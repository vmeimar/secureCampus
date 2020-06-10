<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ 1 ΜΑΘ',
//            'department_id'    =>  1
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ 2 ΜΑΘ',
//            'department_id'    =>  1
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ 1 ΦΥΣΙΚΟ',
//            'department_id'    =>  2
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ 2 ΦΥΣΙΚΟ',
//            'department_id'    =>  2
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ 1 ΒΙΟΛΟΓΙΑ',
//            'department_id'    =>  3
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ 2 ΒΙΟΛΟΦΙΑ',
//            'department_id'    =>  3
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ ΑΓΓΛΙΚΑ',
//            'department_id'    =>  4
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ ΙΣΠΑΝΙΚΑ',
//            'department_id'    =>  5
        ]);

        Location::create([
            'name' =>  'ΣΗΜΕΙΟ ΦΥΛΑΞΗΣ ΙΣΤΟΡΙΚΟ',
//            'department_id'    =>  6
        ]);
    }
}
