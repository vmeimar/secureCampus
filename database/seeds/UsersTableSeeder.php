<?php

use App\Location;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

require_once 'include/roles.php';

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        global $adminRole, $doyRole, $epitropiRole, $epoptisRole, $epistatisRole, $userRole;

        User::truncate();
        DB::table('role_user')->truncate();

        $admin = User::create([
            'name'  =>  'ΔΙΑΧΕΙΡΙΣΤΗΣ',
            'email' =>  'admin@admin.com',
            'password'  =>  Hash::make('password'),
        ]);

        $epitropi = User::create([
            'name'  =>  'ΕΠΙΤΡΟΠΗ',
            'email' =>  'epitropi@epitropi.com',
            'password'  =>  Hash::make('password'),
        ]);

        $epoptis = User::create([
            'name'  =>  'ΕΠΟΠΤΗΣ',
            'email' =>  'epoptis@epoptis.com',
            'password'  =>  Hash::make('password'),
        ]);

        $epistatis = User::create([
            'name'  =>  'ΕΠΙΣΤΑΤΗΣ',
            'email' =>  'epistatis@epistatis.com',
            'password'  =>  Hash::make('password'),
        ]);

        $doy = User::create([
            'name'  =>  'ΔΟΥ',
            'email' =>  'doy@doy.com',
            'password'  =>  Hash::make('password'),
        ]);

        $user = User::create([
            'name'  =>  'ΓΕΝΙΚΟΣ ΧΡΗΣΤΗΣ',
            'email' =>  'user@user.com',
            'password'  =>  Hash::make('password'),
        ]);

        $admin->locations()->attach(Location::all());
        $epitropi->locations()->attach(Location::all());

        $admin->roles()->attach($adminRole);
        $doy->roles()->attach($doyRole);
        $epitropi->roles()->attach($epitropiRole);
        $epistatis->roles()->attach($epistatisRole);
        $user->roles()->attach($userRole);
        $epoptis->roles()->attach($epoptisRole);
    }
}
