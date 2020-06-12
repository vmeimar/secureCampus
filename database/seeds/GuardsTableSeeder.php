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
            'name' => 'Βαγγέλης',
            'surname' => 'Μεϊμάρογλου',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Χριστίνα',
            'surname' => 'Φίλιππα',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Βάγια',
            'surname' => 'Κυριακίδου',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Θωμάς',
            'surname' => 'Σφηκόπουλος',
            'company_id' => 1,
        ]);

        Guard::create([
            'name' => 'Γιάννης',
            'surname' => 'Βενετικίδης',
            'company_id' => 2,
        ]);

        Guard::create([
            'name' => 'Βασίλης',
            'surname' => 'Πιέρρος',
            'company_id' => 2,
        ]);

        Guard::create([
            'name' => 'Νίκος',
            'surname' => 'Χειλάκος',
            'company_id' => 2,
        ]);

        Guard::create([
            'name' => 'Βασίλης',
            'surname' => 'Κανέλης',
            'company_id' => 2,
        ]);
    }
}
