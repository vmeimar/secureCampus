<?php

use App\DayFrame;
use Illuminate\Database\Seeder;

class DayFramesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DayFrame::create([
            'start_frame'   =>  '06:00',
            'end_frame'   =>  '14:00',
            'name'   =>  'morning',
            'greek_name'    =>  'Πρωί',
        ]);

        DayFrame::create([
            'start_frame'   =>  '14:00',
            'end_frame'   =>  '22:00',
            'name'   =>  'evening',
            'greek_name'    =>  'Απόγευμα',
        ]);

        DayFrame::create([
            'start_frame'   =>  '22:00',
            'end_frame'   =>  '06:00',
            'name'   =>  'night',
            'greek_name'    =>  'Βράδυ',
        ]);
    }
}
