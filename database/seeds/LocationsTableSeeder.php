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
            'name' =>  'Φιλοσοφική',   //1
        ]);

        Location::create([
            'name' =>  'Διδασκαλείο Νέας Ελληνικής', //2
        ]);

        Location::create([
            'name' =>  'Βιβλιοθήκη Φιλοσοφικής',    //3
        ]);

        Location::create([
            'name' =>  'Θεολογική',    //4
        ]);

        Location::create([
            'name' =>  'Πληροφορική και Τηλεπικοινωνίες',  //5
        ]);

        Location::create([
            'name' =>  'Φυσική',   //6
        ]);

        Location::create([
            'name' =>  'Χημεία',   //7
        ]);

        Location::create([
            'name' =>  'Βιολογία', //8
        ]);

        Location::create([
            'name' =>  'Γεωλογία και Γεωπεριβάλλον',    //9
        ]);

        Location::create([
            'name' =>  'Νέο Μαθηματικό',  //10
        ]);

        Location::create([
            'name' =>  'Παλαιό Μαθηματικό',   //11
        ]);

        Location::create([
            'name' =>  'Φαρμακευτική', //12
        ]);

        Location::create([
            'name' =>  'ΙΦΕ (Γραμματεία)',  //13
        ]);

        Location::create([
            'name' =>  'ΙΦΕ (Αίθουσες)',    //14
        ]);

        Location::create([
            'name' =>  'Βιβλιοθήκη ΣΘΕ',   //15
        ]);

        Location::create([
            'name' =>  'ΤΥΠΑ - ΕΛΚΕ',   //16
        ]);

        Location::create([
            'name' =>  'ΕΛΚΕ - ΚΕΠΑ',   //17
        ]);

        Location::create([
            'name' =>  'Παιδικός Σταθμός 2 (Ούλοφ Πάλμε)',  //18
        ]);

        Location::create([
            'name' =>  'Οδοντιατρική', //19
        ]);

        Location::create([
            'name' =>  'Ιατρική Μικράς Ασίας', //20
        ]);

        Location::create([
            'name' =>  'Ιατρική Τετραπόλεως',  //21
        ]);

        Location::create([
            'name' =>  'Ιατρική Αττικό',   //22
        ]);

        Location::create([
            'name' =>  'Μονάδες Ιατρικής Παπαδιαμαντοπούλου',   //23
        ]);

        Location::create([
            'name' =>  'Βιβλιοθήκη Επιστημών Υγείας',  //24
        ]);

        Location::create([
            'name' =>  'Νοσηλευτική',  //25
        ]);

        Location::create([
            'name' =>  'ΣΕΦΑΑ', //26
        ]);

        Location::create([
            'name' =>  'Πανεπιστημιακή Λέσχη',    //27
        ]);

        Location::create([
            'name' =>  'Νέο Χημείο',  //28
        ]);

        Location::create([
            'name' =>  'ΠΤΔΕ Ιπποκράτους 20',   //29
        ]);

        Location::create([
            'name' =>  'Τμήμα Τουρκικών και Ασιατικών Σπουδών',   //30
        ]);

        Location::create([
            'name' =>  'ΠΕΔΔ Θεμιστοκλέους και Γαμβέττα',   //31
        ]);

        Location::create([
            'name' =>  'ΠΕΔΔ Αιόλου 42',    //32
        ]);

        Location::create([
            'name' =>  'Γρυπάρειο Αριστείδου 11',   //33
        ]);

        Location::create([
            'name' =>  'Γρυπάρειο Σοφοκλέους 1',    //34
        ]);

        Location::create([
            'name' =>  'Παλαιό Χημείο',   //35
        ]);

        Location::create([
            'name' =>  'Μουσείο Ιστορίας Θόλου',    //36
        ]);

        Location::create([
            'name' =>  'Πανεπιστημίου 30',  //37
        ]);

        Location::create([
            'name' =>  'Εποπτεία Πανεπιστημιούπολης 1',    //38
        ]);

        Location::create([
            'name' =>  'Εποπτεία Πανεπιστημιούπολης 2',   //39
        ]);
    }
}
