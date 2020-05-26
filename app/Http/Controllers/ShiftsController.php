<?php

namespace App\Http\Controllers;

use App\Department;
use App\Shift;
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

    public function index()
    {
        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', Auth::id());
        }

        $shifts = Shift::all();

        return view('shift.index', compact('shifts'));
    }

    public function edit(Shift $shift)
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

        return view('shift.edit', compact('shift', 'departments'));
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
        $authUser = User::find(Auth::id());

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        $data = \request()->validate([
            'location' => 'required',
            'number-of-guards' => 'required',
            'shift-name' => 'required',
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

        return redirect('/shift/index');
    }

    public function update(Shift $shift)
    {
        $authUser = User::find(Auth::id());

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        $data = \request()->validate([
            'location' => 'required',
            'number-of-guards' => 'required',
            'shift-name' => 'required',
        ]);

        $location_id = DB::table('locations')
            ->select('id')
            ->where('name', '=', $data['location'])
            ->first();

        $now = Carbon::now();

        if ($shift->update([
            'location_id'  =>  $location_id->id,
            'number_of_guards'  =>  $data['number-of-guards'],
            'name'  =>  $data['shift-name'],
            'shift_from'    =>  $now->toDateTimeString(),
            'shift_until'    =>  $now->toDateTimeString(),
        ]))
        {
            \request()->session()->flash('success', 'Shift updated successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while updating shift');
        }

        return redirect('/shift/index');
    }

    public function destroy(Shift $shift)
    {
        $authUser = User::find(Auth::id());

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        if ($shift->delete())
        {
            \request()->session()->flash('success', 'Shift deleted successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while deleting shift');
        }

        return redirect('/shift/index');
    }

    public function isActive(Shift $shift)
    {
        $now = Carbon::now();

        if ($shift->shift_from->lt($now) && $shift->shift_until->gt($now))
        {
            return true;
        }
        return false;
    }
}
