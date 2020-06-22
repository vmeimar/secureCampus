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
            'name'  =>  'Κτήριο Φιλοσοφικής Καθημερινές Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '23:00',
            'shift_until'   =>  '07:00',
            'shift_type'   =>  'Weekdays',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Σάββατο Πρωί',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Σάββατο Απόγευμα',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Σάββατο Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Saturday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Κυριακή / Αργία Πρωί',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Κυριακή / Αργία Απόγευμα',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Κυριακή / Αργία Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
            'shift_type'   =>  'Sunday',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Διδασκαλείου Πρωί',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Διδασκαλείου Απόγευμα',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Διδασκαλείου Βράδυ',
            'location_id'   => 2,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Καθημερινές Πρωί',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Καθημερινές Απόγευμα',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Σ/Κ Πρωί',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Σ/Κ Απόγευμα',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Βιβλιοθήκη Φιλοσοφικής Σ/Κ Βράδυ',
            'location_id'   => 3,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Θεολογικής Καθημερινές Απόγευμα',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Θεολογικής Καθημερινές Βράδυ',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '23:00',
            'shift_until'   =>  '08:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Θεολογικής Σ/Κ Πρωί',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Θεολογικής Σ/Κ Απόγευμα',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Θεολογικής Σ/Κ Βράδυ',
            'location_id'   => 4,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Καθημερινές Απόγευμα',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Καθημερινές Βράδυ',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Σ/Κ Πρωί',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Σ/Κ Απόγευμα',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πληροφορικής & Τηλ/νιών Σ/Κ Βράδυ',
            'location_id'   => 5,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Καθημερινές Πρωί',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Καθημερινές Βράδυ',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Σ/Κ Πρωί',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Σ/Κ Απόγευμα',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φυσικής Σ/Κ Βράδυ',
            'location_id'   => 6,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Καθημερινές Απόγευμα',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Καθημερινές Βράδυ',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Σ/Κ Πρωί',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Σ/Κ Απόγευμα',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Χημείας Σ/Κ Βράδυ',
            'location_id'   => 7,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Καθημερινές Απόγευμα',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Καθημερινές Βράδυ',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Σ/Κ Πρωί',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Σ/Κ Απόγευμα',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιολογίας Σ/Κ Βράδυ',
            'location_id'   => 8,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Καθημερινές Πρωί',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Καθημερινές Απόγευμα',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Καθημερινές Βράδυ',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Σ/Κ Πρωί',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Σ/Κ Απόγευμα',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γεωλογίας & Γεωπεριβάλλοντος Σ/Κ Βράδυ',
            'location_id'   => 9,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Μαθηματικού Καθημερινές Απόγευμα',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Μαθηματικού Καθημερινές Βράδυ',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Μαθηματικού Σ/Κ Πρωί',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Μαθηματικού Σ/Κ Απόγευμα',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Μαθηματικού Σ/Κ Βράδυ',
            'location_id'   => 10,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Μαθηματικού Καθημερινές Βράδυ',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '08:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Μαθηματικού Σ/Κ Πρωί',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Μαθηματικού Σ/Κ Απόγευμα',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Μαθηματικού Σ/Κ Βράδυ',
            'location_id'   => 11,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Πρωί',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Απόγευμα',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Βράδυ',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Σ/Κ Πρωί',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Απόγευμα',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Καθημερινές Πρωί',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φαρμακευτικού Σ/Κ Βράδυ',
            'location_id'   => 12,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Γραμματεία) Καθημερινές Πρωί',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Γραμματεία) Καθημερινές Απόγευμα',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Γραμματεία) Καθημερινές Βράδυ',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Γραμματεία) Σ/Κ Πρωί',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Γραμματεία) Σ/Κ Απόγευμα',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Γραμματεία) Σ/Κ Βράδυ',
            'location_id'   => 13,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Αίθουσες) Καθημερινές Βράδυ',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Αίθουσες) Σ/Κ Πρωί',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Αίθουσες) Σ/Κ Απόγευμα',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΙΦΕ (Αίθουσες) Σ/Κ Βράδυ',
            'location_id'   => 14,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιβλιοθήκης ΣΘΕ Πρωί',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιβλιοθήκης ΣΘΕ Απόγευμα',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιβλιοθήκης ΣΘΕ Βράδυ',
            'location_id'   => 15,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΤΥΠΑ - ΕΛΚΕ Καθημερινές Απόγευμα',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΤΥΠΑ - ΕΛΚΕ Καθημερινές Βράδυ',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΤΥΠΑ - ΕΛΚΕ Σ/Κ Πρωί',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΤΥΠΑ - ΕΛΚΕ Σ/Κ Απόγευμα',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΤΥΠΑ - ΕΛΚΕ Σ/Κ Βράδυ',
            'location_id'   => 16,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΕΛΚΕ - ΚΕΠΑ Καθημερινές Πρωί',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΕΛΚΕ - ΚΕΠΑ Καθημερινές Απόγευμα',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΕΛΚΕ - ΚΕΠΑ Σ/Κ Πρωί',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΕΛΚΕ - ΚΕΠΑ Σ/Κ Απόγευμα',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΕΛΚΕ - ΚΕΠΑ Σ/Κ Βράδυ',
            'location_id'   => 17,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Παιδικός Σταθμός 2 Ούλοφ Πάλμε Πρωί',
            'location_id'   => 18,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '07:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Παιδικός Σταθμός 2 Ούλοφ Πάλμε Απόγευμα',
            'location_id'   => 18,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '18:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Οδοντιατρικής Καθημερινές Απόγευμα',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Οδοντιατρικής Καθημερινές Βράδυ',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Οδοντιατρικής Σ/Κ Πρωί',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Οδοντιατρικής Σ/Κ Απόγευμα',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Οδοντιατρικής Σ/Κ Βράδυ',
            'location_id'   => 19,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Μ. Ασίας Καθημερινές Πρωί',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Μ. Ασίας Καθημερινές Απόγευμα',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Μ. Ασίας Καθημερινές Βράδυ',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Μ. Ασίας Σ/Κ Πρωί',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Μ. Ασίας Σ/Κ Απόγευμα',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Μ. Ασίας Σ/Κ Βράδυ',
            'location_id'   => 20,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Τετραπόλεως Καθημερινές Απόγευμα',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Τετραπόλεως Καθημερινές Βράδυ',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '08:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Τετραπόλεως Σ/Κ Πρωί',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Τετραπόλεως Σ/Κ Απόγευμα',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Τετραπόλεως Σ/Κ Βράδυ',
            'location_id'   => 21,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Αττικό Πρωί',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Αττικό Απόγευμα',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Ιατρικής Αττικό Βράδυ',
            'location_id'   => 22,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μονάδων Ιατρικής Παπαδιαμαντοπούλου Πρωί',
            'location_id'   => 23,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μονάδων Ιατρικής Παπαδιαμαντοπούλου Απόγευμα',
            'location_id'   => 23,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιβλιοθήκης Επιστημών Υγείας Πρωί',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιβλιοθήκης Επιστημών Υγείας Απόγευμα',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Βιβλιοθήκης Επιστημών Υγείας Βράδυ',
            'location_id'   => 24,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νοσηλευτικής Απόγευμα',
            'location_id'   => 25,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΣΕΦΑΑ Πρωί',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΣΕΦΑΑ Απόγευμα',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΣΕΦΑΑ Βράδυ',
            'location_id'   => 26,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Καθημερινές Απόγευμα',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '23:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Σάββατο Πρωί',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Σάββατο Απόγευμα',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Σάββατο Βράδυ',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Κυριακή / Αργίες Πρωί',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Κυριακή / Αργίες Απόγευμα',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '16:30',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημιακής Λέσχης Κυριακή / Αργίες Βράδυ',
            'location_id'   => 27,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Χημείου Πρωί',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Χημείου Απόγευμα',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Νέου Χημείου Βράδυ',
            'location_id'   => 28,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΠΤΔΕ Ιπποκράτους 20 Πρωί',
            'location_id'   => 29,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '08:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΠΤΔΕ Ιπποκράτους 20 Απόγευμα',
            'location_id'   => 29,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Τουρκικών & Ασιατικών Σπουδών Πρωί',
            'location_id'   => 30,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '07:50',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Τουρκικών & Ασιατικών Σπουδών Απόγευμα',
            'location_id'   => 30,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '21:50',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΠΕΔΔ Θεμιστοκλέους & Γαμβέττα Πρωί',
            'location_id'   => 31,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΠΕΔΔ Θεμιστοκλέους & Γαμβέττα Απόγευμα',
            'location_id'   => 31,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο ΠΕΔΔ Αιόλου 42 Απόγευμα',
            'location_id'   => 32,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γρυπάρειο Αριστείδου 11 Απόγευμα',
            'location_id'   => 33,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Γρυπάρειο Σοφοκλέους 1 Απόγευμα',
            'location_id'   => 34,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Χημείου Πρωί',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Χημείου Απόγευμα',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Παλαιού Χημείου Βράδυ',
            'location_id'   => 35,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μουσείου Ιστορίας Θόλου Καθημερινές Απόγευμα',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '15:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μουσείου Ιστορίας Θόλου Καθημερινές Βράδυ',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '07:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μουσείου Ιστορίας Θόλου Σ/Κ Πρωί',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μουσείου Ιστορίας Θόλου Σ/Κ Απόγευμα',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Μουσείου Ιστορίας Θόλου Σ/Κ Βράδυ',
            'location_id'   => 36,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημίου 30 Πρωί',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημίου 30 Απόγευμα',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Πανεπιστημίου 30 Βράδυ',
            'location_id'   => 37,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 1 Καθημερινές Πρωί',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 1 Καθημερινές Απόγευμα',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 1 Καθημερινές Βράδυ',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 1 Σ/Κ Πρωί',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 1 Σ/Κ Απόγευμα',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 1 Σ/Κ Βράδυ',
            'location_id'   => 38,
            'user_id'   =>  1,
            'number_of_guards'  =>  3,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Καθημερινές Πρωί (6-8)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '08:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Καθημερινές Πρωί (8-14)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '08:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Καθημερινές Απόγευμα (14-16)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '16:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Καθημερινές Απόγευμα (16-22)',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '16:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Καθημερινές Βράδυ',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  4,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Σ/Κ Πρωί',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Σ/Κ Απόγευμα',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  2,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Εποπτείας Παν/πολης 2 Σ/Κ Βράδυ',
            'location_id'   => 39,
            'user_id'   =>  1,
            'number_of_guards'  =>  4,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
        ]);
    }
}
