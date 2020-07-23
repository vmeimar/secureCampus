<?php

use App\Factor;
use Illuminate\Database\Seeder;

class FactorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Factor::create([
            'name'  =>  'weekdays_morning_rate',
            'rate'   => 1.00,
            'name_greek'   => 'Καθημερινές Πρωί',
        ]);

        Factor::create([
            'name'  =>  'weekdays_evening_rate',
            'rate'   => 1.00,
            'name_greek'   => 'Καθημερινές Απόγευμα',
        ]);

        Factor::create([
            'name'  =>  'weekdays_night_rate',
            'rate'   => 1.25,
            'name_greek'   => 'Καθημερινές Βράδυ',
        ]);

        Factor::create([
            'name'  =>  'saturday_morning_rate',
            'rate'   => 1.25,
            'name_greek'   => 'Σάββατο Πρωί',
        ]);

        Factor::create([
            'name'  =>  'saturday_evening_rate',
            'rate'   => 1.25,
            'name_greek'   => 'Σάββατο Απόγευμα',
        ]);

        Factor::create([
            'name'  =>  'saturday_night_rate',
            'rate'   => 1.75,
            'name_greek'   => 'Σάββατο Βράδυ',
        ]);

        Factor::create([
            'name'  =>  'sunday_morning_rate',
            'rate'   => 1.75,
            'name_greek'   => 'Κυριακή / Αργίες Πρωί',
        ]);

        Factor::create([
            'name'  =>  'sunday_evening_rate',
            'rate'   => 1.75,
            'name_greek'   => 'Κυριακή / Αργίες Απόγευμα',
        ]);

        Factor::create([
            'name'  =>  'sunday_night_rate',
            'rate'   => 2.00,
            'name_greek'   => 'Κυριακή / Αργίες Βράδυ',
        ]);
    }
}
