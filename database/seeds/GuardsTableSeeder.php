<?php

use App\Guard;
use Illuminate\Database\Seeder;

class GuardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guard::create([
            'name' => 'Vaggelis',
            'surname' => 'Meimaroglou',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Chris',
            'surname' => 'Filippa',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Vagia',
            'surname' => 'Kyriakidou',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Thomas',
            'surname' => 'Sfikopoulos',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'John',
            'surname' => 'Venet',
            'company_id' => 2,
        ]);

        Guard::create([
            'name' => 'Vasilis',
            'surname' => 'Pier',
            'company_id' => 2,
        ]);
    }
}
