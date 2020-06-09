<?php

namespace App\Http\Controllers;

use App\Department;
use App\Guard;
use App\Shift;
use App\User;
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
        $shifts = Shift::all();
        return view('shift.index', compact('shifts'));
    }

    public function show(Shift $shift)
    {
        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('shift.show', compact('guards', 'shift'));
    }

    public function edit(Shift $shift)
    {
        $authUser = User::find(Auth::id());

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
            \request()->session()->flash('success', 'Επιτυχής δημιουργία βάρδιας σε σημείο φύλαξης');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά τη δημιουργία');
        }

        return redirect('/shift/index');
    }

    public function update(Shift $shift)
    {
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
            \request()->session()->flash('success', 'Επιτυχής αποθήκευση');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά την αποθήκευση');
        }

        return redirect('/shift/index');
    }

    public function destroy(Shift $shift)
    {
        if ( $shift->delete() )
        {
            \request()->session()->flash('success', 'Επιτυχής διαγραφή');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά τη διαγραφή');
        }

        return redirect('/shift/index');
    }
}
