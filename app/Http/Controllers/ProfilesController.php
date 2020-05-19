<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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

        if (Auth::id() == $user->id)
        {
            return view('profile.index', compact('user'));
        }
        return redirect()->route('profile', ['user' => Auth::id()]);
    }
}
