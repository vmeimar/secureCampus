<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(GuardsTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(FactorsTableSeeder::class);
        $this->call(DayFramesTableSeeder::class);
    }
}
