<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $authUser = User::find(Auth::id());

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        if (Gate::allows('manage-anything'))
        {
            $departments = Department::all();
        }
        else
        {
            $departments = Department::where('id', $authUser->department_id)->get();
        }

        return view('shift.create', compact( 'departments') );
    }

    public function store()
    {
        $data = \request()->validate([
            'location' => 'required',
            'number-of-guards' => 'required',
            'shift-name' => 'required',
//            'shift_date' => 'required',
//            'shift_from_hour' => 'required',
//            'shift_from_minute' => 'required',
//            'shift_until_hour' => 'required',
//            'shift_until_minute' => 'required',
        ]);

        $now = Carbon::now();

        if (auth()->user()->shifts()->create([
            'location_id'  =>  $data['location'],
            'number_of_guards'  =>  $data['number-of-guards'],
            'name'  =>  $data['shift-name'],
            'shift_from'    =>  $now->toDateTimeString(),
            'shift_until'    =>  $now->toDateTimeString(),
        ]))
        {
            \request()->session()->flash('success', 'Shift created successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while creating shift');
        }

        return redirect('/profile/' . Auth::id());
    }
}
