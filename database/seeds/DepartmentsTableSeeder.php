<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::truncate();

        Department::create([
            'name' =>  'ΤΜΗΜΑ ΜΑΘΗΜΑΤΙΚΩΝ',
            'faculty_id'    =>  1
            ]);

        Department::create([
            'name' =>  'ΤΜΗΜΑ ΦΥΣΙΚΗΣ',
            'faculty_id'    =>  1
        ]);

        Department::create([
            'name' =>  'ΤΜΗΜΑ ΒΙΟΛΟΓΙΑΣ',
            'faculty_id'    =>  1
        ]);

        Department::create([
            'name' =>  'ΤΜΗΜΑ ΑΓΓΛΙΚΗΣ ΦΙΛΟΛΟΓΙΑΣ',
            'faculty_id'    =>  2
        ]);

        Department::create([
            'name' =>  'ΤΜΗΜΑ ΙΣΠΑΝΙΚΗΣ ΦΙΛΟΛΟΓΙΑΣ',
            'faculty_id'    =>  2
        ]);

        Department::create([
            'name' =>  'ΙΣΤΟΡΙΚΟ ΑΡΧΑΙΟΛΟΓΙΚΟ',
            'faculty_id'    =>  2
        ]);
    }
}
