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
        ]);

        DayFrame::create([
            'start_frame'   =>  '14:00',
            'end_frame'   =>  '22:00',
            'name'   =>  'evening',
        ]);

        DayFrame::create([
            'start_frame'   =>  '22:00',
            'end_frame'   =>  '06:00',
            'name'   =>  'night',
        ]);
    }
}
