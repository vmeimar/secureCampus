<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class ShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        if (Gate::denies('manage-shifts'))
        {
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $guards = DB::table('guards')
            ->where('active', '=', '1')
            ->get();

        $locations = DB::table('locations')
            ->get();


        return view('shift.create', compact('guards', 'locations'));
    }

    public function store()
    {
        $data = \request()->validate([
            'guard' => 'required',
            'location' => 'required',
//            'shift_from' => 'required',
//            'shift_until' => 'required',
        ]);

        $now = Carbon::now();

        auth()->user()->shifts()->create([
            'guard_id'  =>  $data['guard'],
            'location_id'  =>  $data['location'],
            'shift_from'    =>  $now->toDateTimeString(),
            'shift_until'    =>  $now->toDateTimeString(),
        ]);

        return redirect('/profile/' . \auth()->user()->id);
    }
}
