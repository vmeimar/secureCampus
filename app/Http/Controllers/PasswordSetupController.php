<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PasswordSetupController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getSetPassword($token)
    {
        $user = User::where('register_token', '=', $token)->first();

        if ($user->exists())
        {
            return view('users.password-set', compact('user', 'token'));
        }
        else
        {
            \request()->session()->flash('error', 'Δε βρέθηκε χρήστης με αυτό το token.');
            return redirect('/home');
        }
    }

    public function postSetPassword(Request $request)
    {
        $data = $request->validate([
            'password'  =>  'required|confirmed',
            'token'     =>  'required',
        ]);

        $user = User::where('register_token', '=', $data['token'])->first();

        $user->update([
            'password'  =>  bcrypt($data['password']),
            'register_token'     =>  '',
        ]);

        return redirect(route('profile', $user));
    }
}
