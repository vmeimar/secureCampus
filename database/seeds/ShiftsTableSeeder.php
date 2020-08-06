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
            'name'  =>  'Φιλοσοφική Καθημερινές Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '23:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Φιλοσοφική Σάββατο Πρωί',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Φιλοσοφική Σάββατο Απόγευμα',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Φιλοσοφική Σάββατο Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Φιλοσοφική Κυριακή/Αργίες Πρωί',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Φιλοσοφική Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Φιλοσοφική Κυριακή/Αργίες Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Καθημερινές Πρωί',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Καθημερινές Απόγευμα',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Καθημερινές Βράδυ',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Σάββατο Πρωί',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Σάββατο Απόγευμα',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Σάββατο Βράδυ',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Κυριακή/Αργίες Πρωί',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Διδασκαλείο Κυριακή/Αργίες Βράδυ',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Καθημερινές Πρωί',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Καθημερινές Απόγευμα',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Σάββατο Πρωί',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Σάββατο Απόγευμα',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Σάββατο Βράδυ',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Κυριακή/Αργίες Πρωί',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Κυριακή/Αργίες Βράδυ',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Καθημερινές Απόγευμα',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Καθημερινές Βράδυ',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '23:00',
            'shift_until'   =>  '08:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Σάββατο Πρωί',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Σάββατο Απόγευμα',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Σάββατο Βράδυ',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Κυριακή/Αργίες Πρωί',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Θεολογική Κυριακή/Αργίες Βράδυ',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Καθημερινές Απόγευμα',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Καθημερινές Βράδυ',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Σάββατο Πρωί',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Σάββατο Απόγευμα',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Σάββατο Βράδυ',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Κυριακή/Αργίες Πρωί',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Κυριακή/Αργίες Βράδυ',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Καθημερινές Πρωί',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Καθημερινές Βράδυ',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Σάββατο Πρωί',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Σάββατο Απόγευμα',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Σάββατο Βράδυ',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Κυριακή/Αργίες Πρωί',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Κυριακή/Αργίες Βράδυ',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Καθημερινές Απόγευμα',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Καθημερινές Βράδυ',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Σάββατο Πρωί',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Σάββατο Απόγευμα',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Σάββατο Βράδυ',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Κυριακή/Αργίες Πρωί',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Κυριακή/Αργίες Βράδυ',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Καθημερινές Απόγευμα',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Καθημερινές Βράδυ',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Σάββατο Πρωί',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Σάββατο Απόγευμα',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Σάββατο Βράδυ',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Κυριακή/Αργίες Πρωί',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Κυριακή/Αργίες Βράδυ',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Καθημερινές Πρωί',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Καθημερινές Απόγευμα',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Καθημερινές Βράδυ',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Σάββατο Πρωί',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Σάββατο Απόγευμα',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Σάββατο Βράδυ',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Κυριακή/Αργίες Πρωί',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Κυριακή/Αργίες Βράδυ',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Καθημερινές Απόγευμα',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Καθημερινές Βράδυ',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Σάββατο Πρωί',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Σάββατο Απόγευμα',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Σάββατο Βράδυ',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Κυριακή/Αργίες Πρωί',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Μαθηματικό Κυριακή/Αργίες Βράδυ',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Καθημερινές Βράδυ',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '08:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Σάββατο Πρωί',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Σάββατο Απόγευμα',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Σάββατο Βράδυ',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Κυριακή/Αργίες Πρωί',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Μαθηματικό Κυριακή/Αργίες Βράδυ',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Πρωί',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Απόγευμα',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Βράδυ',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Σάββατο Πρωί',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Σάββατο Βράδυ',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Κυριακή/Αργίες Πρωί',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Κυριακή/Αργίες Βράδυ',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Καθημερινές Πρωί',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Καθημερινές Απόγευμα',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Καθημερινές Βράδυ',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Σάββατο Πρωί',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Σάββατο Απόγευμα',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Σάββατο Βράδυ',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Κυριακή/Αργίες Πρωί',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Γραμματεία) Κυριακή/Αργίες Βράδυ',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Αίθουσες) Καθημερινές Βράδυ',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Αίθουσες) Σ/Κ Πρωί',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Αίθουσες) Σάββατο Απόγευμα',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Αίθουσες) Σάββατο Βράδυ',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Αίθουσες) Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΙΦΕ (Αίθουσες) Κυριακή/Αργίες Βράδυ',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Καθημερινές Πρωί',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Καθημερινές Απόγευμα',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Καθημερινές Βράδυ',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Σάββατο Πρωί',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Σάββατο Απόγευμα',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Σάββατο Βράδυ',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Κυριακή/Αργίες Πρωί',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη ΣΘΕ Κυριακή/Αργίες Βράδυ',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Καθημερινές Απόγευμα',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Καθημερινές Βράδυ',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Σάββατο Πρωί',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Σάββατο Απόγευμα',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Σάββατο Βράδυ',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Κυριακή/Αργίες Πρωί',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΤΥΠΑ - ΕΛΚΕ Κυριακή/Αργίες Βράδυ',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Καθημερινές Πρωί',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Καθημερινές Απόγευμα',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Σάββατο Πρωί',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Σάββατο Απόγευμα',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Σάββατο Βράδυ',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Κυριακή/Αργίες Πρωί',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΕΛΚΕ - ΚΕΠΑ Κυριακή/Αργίες Βράδυ',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παιδικός Σταθμός 2 Ούλοφ Πάλμε Καθημερινές Πρωί',
            'location_id'   => 18,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '07:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Παιδικός Σταθμός 2 Ούλοφ Πάλμε Καθημερινές Απόγευμα',
            'location_id'   => 18,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '18:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Καθημερινές Απόγευμα',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Καθημερινές Βράδυ',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Σάββατο Πρωί',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Σάββατο Απόγευμα',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Σάββατο Βράδυ',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Κυριακή/Αργίες Πρωί',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Οδοντιατρική Κυριακή/Αργίες Βράδυ',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Καθημερινές Πρωί',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Καθημερινές Απόγευμα',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Καθημερινές Βράδυ',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Σάββατο Πρωί',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Σάββατο Απόγευμα',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Σάββατο Βράδυ',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Κυριακή/Αργίες Πρωί',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Μ. Ασίας Κυριακή/Αργίες Βράδυ',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Καθημερινές Απόγευμα',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Καθημερινές Βράδυ',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '08:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Σάββατο Πρωί',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Σάββατο Απόγευμα',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Σάββατο Βράδυ',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Κυριακή/Αργίες Πρωί',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Τετραπόλεως Κυριακή/Αργίες Βράδυ',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Καθημερινές Πρωί',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Καθημερινές Απόγευμα',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Καθημερινές Βράδυ',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Σάββατο Πρωί',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Σάββατο Απόγευμα',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Σάββατο Βράδυ',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Κυριακή/Αργίες Πρωί',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Ιατρική Αττικό Κυριακή/Αργίες Βράδυ',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Μονάδες Ιατρικής Παπαδιαμαντοπούλου Καθημερινές Πρωί',
            'location_id'   => 23,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Μονάδες Ιατρικής Παπαδιαμαντοπούλου Καθημερινές Απόγευμα',
            'location_id'   => 23,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Καθημερινές Πρωί',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Καθημερινές Απόγευμα',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Καθημερινές Βράδυ',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Σάββατο Πρωί',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Σάββατο Απόγευμα',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Σάββατο Βράδυ',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Κυριακή/Αργίες Πρωί',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Επιστημών Υγείας Κυριακή/Αργίες Βράδυ',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νοσηλευτική Καθημερινές Απόγευμα',
            'location_id'   => 25,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Σάββατο Πρωί',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Κυριακή/Αργίες Πρωί',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Καθημερινές Απόγευμα',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Καθημερινές Βράδυ',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Σάββατο Απόγευμα',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Σάββατο Βράδυ',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΣΕΦΑΑ Κυριακή/Αργίες Βράδυ',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Καθημερινές Απόγευμα',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '23:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Σάββατο Πρωί',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Σάββατο Απόγευμα',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Σάββατο Βράδυ',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Κυριακή/Αργίες Πρωί',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:30',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημιακή Λέσχη Κυριακή/Αργίες Βράδυ',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Σάββατο Πρωί',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Κυριακή/Αργίες Πρωί',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Καθημερινές Απόγευμα',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Καθημερινές Βράδυ',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Σάββατο Απόγευμα',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Σάββατο Βράδυ',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Νέο Χημείο Κυριακή/Αργίες Βράδυ',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'ΠΤΔΕ Ιπποκράτους Καθημερινές 20 Πρωί',
            'location_id'   => 29,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '08:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΠΤΔΕ Ιπποκράτους Καθημερινές 20 Απόγευμα',
            'location_id'   => 29,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Τουρκικών & Ασιατικών Σπουδών Καθημερινές Πρωί',
            'location_id'   => 30,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '07:50',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Τουρκικών & Ασιατικών Σπουδών Καθημερινές Απόγευμα',
            'location_id'   => 30,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '21:50',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΠΕΔΔ Θεμιστοκλέους & Γαμβέττα Σάββατο Πρωί',
            'location_id'   => 31,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΠΕΔΔ Θεμιστοκλέους & Γαμβέττα Σάββατο Απόγευμα',
            'location_id'   => 31,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'ΠΕΔΔ Θεμιστοκλέους & Γαμβέττα Καθημερινές Απόγευμα',
            'location_id'   => 31,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΠΕΔΔ Αιόλου 42 Καθημερινές Απόγευμα',
            'location_id'   => 32,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'ΠΕΔΔ Αιόλου 42 Καθημερινές Βράδυ',
            'location_id'   => 32,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Γρυπάρειο Αριστείδου 11 Καθημερινές Απόγευμα',
            'location_id'   => 33,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Γρυπάρειο Σοφοκλέους 1 Καθημερινές Απόγευμα',
            'location_id'   => 34,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Σάββατο Πρωί',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Σάββατο Απόγευμα',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Σάββατο Βράδυ',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Κυριακή/Αργίες Πρωί',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Κυριακή/Αργίες Βράδυ',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Παλαιό Χημείο Καθημερινές Βράδυ',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Καθημερινές Απόγευμα',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Καθημερινές Βράδυ',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Σάββατο Πρωί',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Σάββατο Απόγευμα',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Σάββατο Βράδυ',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Κυριακή/Αργίες Πρωί',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Μουσείο Ιστορίας Θόλου Κυριακή/Αργίες Βράδυ',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Καθημερινές Πρωί',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Καθημερινές Απόγευμα',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Καθημερινές Βράδυ',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Σάββατο Πρωί',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Σάββατο Απόγευμα',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Σάββατο Βράδυ',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Κυριακή/Αργίες Πρωί',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Πανεπιστημίου 30 Κυριακή/Αργίες Βράδυ',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Καθημερινές Πρωί',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Καθημερινές Απόγευμα',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Καθημερινές Βράδυ',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Σάββατο Πρωί',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Σάββατο Απόγευμα',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Σάββατο Βράδυ',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Κυριακή/Αργίες Πρωί',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 1 Κυριακή/Αργίες Βράδυ',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Καθημερινές Πρωί (6-8)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '08:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Καθημερινές Πρωί (8-14)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '08:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Καθημερινές Απόγευμα (14-16)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '16:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Καθημερινές Απόγευμα (16-22)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Καθημερινές Βράδυ',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  4,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Σάββατο Πρωί',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Σάββατο Απόγευμα',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Σάββατο Βράδυ',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  4,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Κυριακή/Αργίες Πρωί',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Κυριακή/Αργίες Απόγευμα',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Εποπτεία Παν/πολης 2 Κυριακή/Αργίες Βράδυ',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  4,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);
    }
}
