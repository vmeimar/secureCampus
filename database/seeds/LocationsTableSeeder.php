<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' =>  'Φιλοσοφικής',   //1
        ]);

        Location::create([
            'name' =>  'Διδασκαλείου Νέας Ελληνικής', //2
        ]);

        Location::create([
            'name' =>  'Βιβλιοθήκη Φιλοσοφικής',    //3
        ]);

        Location::create([
            'name' =>  'Θεολογικής',    //4
        ]);

        Location::create([
            'name' =>  'Πληροφορικής και Τηλεπικοινωνιών',  //5
        ]);

        Location::create([
            'name' =>  'Φυσικής',   //6
        ]);

        Location::create([
            'name' =>  'Χημείας',   //7
        ]);

        Location::create([
            'name' =>  'Βιολογίας', //8
        ]);

        Location::create([
            'name' =>  'Γεωλογίας και Γεωπεριβάλλοντος',    //9
        ]);

        Location::create([
            'name' =>  'Νέου Μαθηματικού',  //10
        ]);

        Location::create([
            'name' =>  'Παλαιού Μαθηματικού',   //11
        ]);

        Location::create([
            'name' =>  'Φαρμακευτικού', //12
        ]);

        Location::create([
            'name' =>  'ΙΦΕ (Γραμματεία)',  //13
        ]);

        Location::create([
            'name' =>  'ΙΦΕ (Αίθουσες)',    //14
        ]);

        Location::create([
            'name' =>  'Βιβλιοθήκης ΣΘΕ',   //15
        ]);

        Location::create([
            'name' =>  'ΤΥΠΑ - ΕΛΚΕ',   //16
        ]);

        Location::create([
            'name' =>  'ΕΛΚΕ - ΚΕΠΑ',   //17
        ]);

        Location::create([
            'name' =>  'Παιδικού Σταθμού 2 (Ούλοφ Πάλμε)',  //18
        ]);

        Location::create([
            'name' =>  'Οδοντιατρικής', //19
        ]);

        Location::create([
            'name' =>  'Ιατρικής Μικράς Ασίας', //20
        ]);

        Location::create([
            'name' =>  'Ιατρικής Τετραπόλεως',  //21
        ]);

        Location::create([
            'name' =>  'Ιατρικής Αττικό',   //22
        ]);

        Location::create([
            'name' =>  'Μονάδων Ιατρικής Παπαδιαμαντοπούλου',   //23
        ]);

        Location::create([
            'name' =>  'Βιβλιοθήκης Επιστημών Υγείας',  //24
        ]);

        Location::create([
            'name' =>  'ΣΕΦΑΑ', //25
        ]);

        Location::create([
            'name' =>  'Πανεπιστημιακής Λέσχης',    //26
        ]);

        Location::create([
            'name' =>  'Νέου Χημείου',  //27
        ]);

        Location::create([
            'name' =>  'ΠΤΔΕ Ιπποκράτους 20',   //28
        ]);

        Location::create([
            'name' =>  'Τουρκικών και Ασιατικών Σπουδών',   //29
        ]);

        Location::create([
            'name' =>  'ΠΕΔΔ Θεμιστοκλέους και Γαμβέττα',   //30
        ]);

        Location::create([
            'name' =>  'ΠΕΔΔ Αιόλου 42',    //31
        ]);

        Location::create([
            'name' =>  'Γρυπάρειο Αριστείδου 11',   //32
        ]);

        Location::create([
            'name' =>  'Γρυπάρειο Σοφοκλέους 1',    //33
        ]);

        Location::create([
            'name' =>  'Παλαιού Χημείου',   //34
        ]);

        Location::create([
            'name' =>  'Μουσείο Ιστορίας Θόλου',    //35
        ]);

        Location::create([
            'name' =>  'Πανεπιστημίου 30',  //36
        ]);

        Location::create([
            'name' =>  'Εποπτείας Πανεπιστημιούπολης 1',    //37
        ]);

        Location::create([
            'name' =>  'Εποπτείας Πανεπιστημιούπολης 2',   //38
        ]);
    }
}
