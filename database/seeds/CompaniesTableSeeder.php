<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name'  =>  'Group4'
        ]);

        Company::create([
            'name'  =>  'Securitades'
        ]);
    }
}
