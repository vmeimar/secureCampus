<?php

namespace App\Http\Controllers;

use App\Department;
use App\Guard;
use App\Shift;
use App\User;
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
//        if (Gate::denies('manage-shifts'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', Auth::id());
//        }

        $shifts = Shift::all();
        return view('shift.index', compact('shifts'));
    }

    public function show(Shift $shift)
    {
//        if (Gate::denies('manage-security'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', ['user' => Auth::id()]);
//        }

        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();

        return view('shift.show', compact('guards', 'shift'));
    }

    public function edit(Shift $shift)
    {
        $authUser = User::find(Auth::id());

//        if (Gate::denies('manage-shifts'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', $authUser->id);
//        }

        if (Gate::allows('see-all'))
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

//        if (Gate::denies('manage-shifts'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', $authUser->id);
//        }

        if (Gate::allows('see-all'))
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

//        if (Gate::denies('manage-shifts'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', $authUser->id);
//        }

        $data = \request()->validate([
            'location' => 'required',
            'shift-from' => 'required',
            'shift-until' => 'required',
            'number-of-guards' => 'required',
            'shift-name' => 'required',
        ]);

        if ( auth()->user()->shifts()->create([
            'location_id'  =>  $data['location'],
            'number_of_guards'  =>  $data['number-of-guards'],
            'name'  =>  $data['shift-name'],
            'shift_from'    =>  $data['shift-from'],
            'shift_until'    =>  $data['shift-until'],
        ]) )
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

//        if (Gate::denies('manage-shifts'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', $authUser->id);
//        }

        $data = \request()->validate([
            'location' => 'required',
            'shift-from' => 'required',
            'shift-until' => 'required',
            'number-of-guards' => 'required',
            'shift-name' => 'required',
        ]);

        $location_id = DB::table('locations')
            ->select('id')
            ->where('name', '=', $data['location'])
            ->first();

        if ($shift->update([
            'location_id'  =>  $location_id->id,
            'number_of_guards'  =>  $data['number-of-guards'],
            'name'  =>  $data['shift-name'],
            'shift_from'    =>  $data['shift-from'],
            'shift_until'    =>  $data['shift-until'],
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

//        if (Gate::denies('manage-shifts'))
//        {
//            \request()->session()->flash('warning', 'unauthorized action');
//            return redirect()->route('profile', $authUser->id);
//        }

        $shift_guards = $shift->guarded()->get();

        if ( isset($shift_guards) && $shift_guards->count() > 0 )
        {
            foreach ($shift_guards as $shift_guard)
            {
                $shift->guarded()->detach($shift_guard);
            }
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
}
