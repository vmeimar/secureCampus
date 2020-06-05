<?php

use App\Shift;
use Illuminate\Database\Seeder;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create([
            'name'  =>  'ΜΑΘΗΜΑΤΙΚΟ 1 ΠΡΩΙ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'ΜΑΘΗΜΑΤΙΚΟ 1 ΑΠΟΓΕΥΜΑ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'ΜΑΘΗΜΑΤΙΚΟ 1 ΒΡΑΔΥ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);
    }
}
