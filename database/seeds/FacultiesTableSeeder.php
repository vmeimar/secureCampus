<?php

use App\Faculty;
use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::truncate();

        Faculty::create(['name' =>  'ΘΕΤΙΚΩΝ ΕΠΙΣΤΗΜΩΝ']);
        Faculty::create(['name' =>  'ΦΙΛΟΣΟΦΙΚΗ']);
    }
}
