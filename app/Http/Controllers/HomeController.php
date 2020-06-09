<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //    ORIGINAL CODE
//    /**
//     * Show the application dashboard.
//     *
//     * @return \Illuminate\Contracts\Support\Renderable
//     */
//    public function index(Request $request)
//    {
//        $user = $request->user();
//        return view('home', compact('user'));
//    }

    public function index (Request $request)
    {
        $user = $request->user();
        return redirect( route('profile', $user) );
    }
}
