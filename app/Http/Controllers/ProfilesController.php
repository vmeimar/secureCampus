<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($user)
    {
        $user = User::findOrFail($user);
        $userRoles = [];

        foreach ($user->roles as $role)
        {
            $userRoles[] = ucfirst($role->name);
        }

        if (Auth::id() == $user->id)
        {
            return view('profile.index', compact('user', 'userRoles'));
        }

        return redirect()->route('profile', ['user' => Auth::id()]);
    }
}
