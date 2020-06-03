<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['name' => 'ΔΙΑΧΕΙΡΙΣΤΗΣ']);
        Role::create(['name' => 'ΕΠΙΤΡΟΠΗ']);
        Role::create(['name' => 'ΕΠΟΠΤΗΣ']);
        Role::create(['name' => 'ΕΠΙΣΤΑΤΗΣ']);
        Role::create(['name' => 'ΔΟΥ']);
        Role::create(['name' => 'ΝΕΟΣ ΧΡΗΣΤΗΣ']);
    }
}
