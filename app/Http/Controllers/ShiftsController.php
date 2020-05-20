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
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        for ($i=0; $i<24; $i++)
        {
            $hours[] = $i;
        }

        for ($i=0; $i<60; $i++)
        {
            $minutes[] = $i;
        }

        $guards = DB::table('guards')
            ->where('active', '=', '1')
            ->get();

        $locations = DB::table('locations')
            ->get();


        return view('shift.create', compact('guards', 'locations', 'hours', 'minutes'));
    }

    public function store()
    {
        $data = \request()->validate([
            'guard' => 'required',
            'location' => 'required',
            'shift_date' => 'required',
            'shift_from_hour' => 'required',
            'shift_from_minute' => 'required',
            'shift_until_hour' => 'required',
            'shift_until_minute' => 'required',
        ]);

//        $now = Carbon::now();

        dd($data);

//        if (auth()->user()->shifts()->create([
//            'guard_id'  =>  $data['guard'],
//            'location_id'  =>  $data['location'],
//            'shift_from'    =>  $now->toDateTimeString(),
//            'shift_until'    =>  $now->toDateTimeString(),
//        ]))
//        {
//            \request()->session()->flash('success', 'Shift created successfully');
//        }
//        else
//        {
//            \request()->session()->flash('error', 'Error while creating shift');
//        }
//
//        return redirect('/profile/' . \auth()->user()->id);
    }
}
