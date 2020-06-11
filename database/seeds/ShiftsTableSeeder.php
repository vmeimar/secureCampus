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
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Σ/Κ Πρωί',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '06:00',
            'shift_until'   =>  '14:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Σ/Κ Απόγευμα',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '14:00',
            'shift_until'   =>  '22:00',
        ]);

        Shift::create([
            'name'  =>  'Κτήριο Φιλοσοφικής Σ/Κ Βράδυ',
            'location_id'   => 1,
            'user_id'   =>  1,
            'number_of_guards'  =>  1,
            'shift_from'    =>  '22:00',
            'shift_until'   =>  '06:00',
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
    }
}
