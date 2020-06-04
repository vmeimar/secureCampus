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

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'epitropi']);
        Role::create(['name' => 'epoptis']);
        Role::create(['name' => 'epistatis']);
        Role::create(['name' => 'doy']);
        Role::create(['name' => 'user']);
    }
}
