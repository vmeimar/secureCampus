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

        $adminRole = Role::where('name', 'admin')->first();
        $supervisorRole = Role::where('name', 'supervisor')->first();
        $secretariatRole = Role::where('name', 'secretariat')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name'  =>  'Admin User',
            'email' =>  'admin@admin.com',
            'password'  =>  Hash::make('password'),
        ]);

        $supervisor = User::create([
            'name'  =>  'Supervisor',
            'email' =>  'super@super.com',
            'password'  =>  Hash::make('password'),
        ]);

        $secretariat = User::create([
            'name'  =>  'Secretariat',
            'email' =>  'secr@secr.com',
            'password'  =>  Hash::make('password'),
        ]);

        $user = User::create([
            'name'  =>  'Generic User',
            'email' =>  'user@user.com',
            'password'  =>  Hash::make('password'),
        ]);

        $admin->roles()->attach($adminRole);
        $secretariat->roles()->attach($secretariatRole);
        $user->roles()->attach($userRole);
        $supervisor->roles()->attach($supervisorRole);
    }
}
