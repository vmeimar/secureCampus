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
        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', Auth::id());
        }

        $shifts = Shift::latest()->paginate(5);

        return view('shift.index', compact('shifts'));
    }

    public function show(Shift $shift)
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();

        return view('shift.show', compact('guards', 'shift'));
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

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

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

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        $shift_guards = $shift->guarded()->get();

        if ( isset($shift_guards) && $shift_guards->count() > 0)
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

    private function calculateFactor(Shift $shift)
    {
        $start = strtotime("07:00");

        $end = strtotime("17:30");
        $end = strtotime("06:00") + 3600*24; // the work ended at 06:00 morning of the next day


        $morning_start = strtotime("06:00");
        $morning_end = strtotime("14:00");

        $afternoon_start = strtotime("14:00");
        $afternoon_end = strtotime("22:00");

        $night_start = strtotime("22:00");
        $night_end = strtotime("06:00") + 3600*24; // 07:00 of next day, add 3600*24 seconds

        echo "morning: " . $this->intersection( $start, $end, $morning_start, $morning_end ) / 3600 . " hours\n";
        echo "afternoon: " . $this->intersection( $start, $end, $afternoon_start, $afternoon_end ) / 3600 . " hours\n";
        echo "night: " . $this->intersection( $start, $end, $night_start, $night_end ) / 3600 . " hours\n";
    }

    private function intersection($s1, $e1, $s2, $e2)
    {
        if ($e1 < $s2)
            return 0;
        if ($s1 > $e2)
            return 0;
        if ($s1 < $s2)
            $s1 = $s2;
        if ($e1 > $e2)
            $e1 = $e2;
        return $e1 - $s1;
    }
}
