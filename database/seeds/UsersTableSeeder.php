<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'ΔΙΑΧΕΙΡΙΣΤΗΣ')->first();
        $doyRole = Role::where('name', 'ΔΟΥ')->first();
        $epitropiRole = Role::where('name', 'ΕΠΙΤΡΟΠΗ')->first();
        $epoptisRole = Role::where('name', 'ΕΠΟΠΤΗΣ')->first();
        $epistatisRole = Role::where('name', 'ΕΠΙΣΤΑΤΗΣ')->first();
        $userRole = Role::where('name', 'ΓΕΝΙΚΟΣ ΧΡΗΣΤΗΣ')->first();

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

        $admin->roles()->attach($adminRole);
        $doy->roles()->attach($doyRole);
        $epitropi->roles()->attach($epitropiRole);
        $epistatis->roles()->attach($epistatisRole);
        $user->roles()->attach($userRole);
        $epoptis->roles()->attach($epoptisRole);
    }
}
