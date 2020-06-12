<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ActiveShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $activeShiftsIds = [];

        if ($user->hasAnyRoles(['admin', 'epitropi']))
        {
            $activeShifts = ActiveShift::latest()->paginate(10);
        }
        else
        {
            $allActiveShifts = ActiveShift::all();

            foreach ($allActiveShifts as $item)
            {
                if ( in_array( $item->shift()->value('location_id'), $user->locations()->pluck('location_id')->toArray() ) )
                {
                    $activeShiftsIds[] = $item->id;
                }
                else continue;
            }
            $activeShifts = ActiveShift::whereIn('id', $activeShiftsIds)->latest()->paginate(10);
        }
        return view('active-shift.index', compact('activeShifts'));
    }

    public function create(Shift $shift)
    {
        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('active-shift.create', compact('shift', 'guards'));
    }

    public function edit(ActiveShift $activeShift)
    {
        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('active-shift.edit', compact('activeShift', 'guards'));
    }

    public function update(ActiveShift $activeShift)
    {
        foreach (request()->except(['_token', '_method', 'active-shift-date', 'shift-id', 'active-shift-comments']) as $item)
        {
            $assignedGuardIds[] = $item;
        }

        $data = request()->all();

        $data['active-shift-id'] = $activeShift->id;

        $overLap = $this->checkShiftOverlap($assignedGuardIds, $data, $activeShift->from);

        if ($overLap)
        {
            request()->session()->flash('warning', 'Δεν αποθηκεύτηκε. Υπάρχει σύγκρουση ωραρίου.');
            return redirect(route('active-shift.index'));
        }

        $calculations = $this->calculateFactor($activeShift->from, $activeShift->until, $data['active-shift-date']);

        if (! $activeShift->update([
            'name'  =>  $activeShift->name,
            'date'  =>  $data['active-shift-date'],
            'from'  =>  $activeShift->from,
            'until' =>  $activeShift->until,
            'comments'  =>  $data['active-shift-comments'],
            'duration'  =>  $calculations['duration'],
            'factor'    =>  ($calculations['morning'] + $calculations['evening'] + $calculations['night']),
        ]))
        {
            request()->session()->flash('error', 'Σφάλμα κατά την αποθήκευση');
            return redirect(route('active-shift.index'));
        }

        $guards = Guard::whereIn('id', $assignedGuardIds)->get();

        try {
            $activeShift->guards()->sync($guards);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        request()->session()->flash('success', 'Επιτυχής αποθήκευση');
        return redirect(route('active-shift.index'));
    }

    public function store(Request $request)
    {
        foreach ($request->except(['_token', 'active-shift-date', 'shift-id']) as $item)
        {
            $assignedGuardIds[] = $item;
        }

        $data = $this->fetchData( count($assignedGuardIds) );

        $staticShift = Shift::findOrFail($data['shift-id']);

        $overLap = $this->checkShiftOverlap($assignedGuardIds, $data, $staticShift->shift_from);

        if ($overLap)
        {
            $request->session()->flash('warning', 'Δεν ανατέθηκε. Υπάρχει σύγκρουση ωραρίου.');
            return redirect(route('active-shift.index'));
        }

        $calculations = $this->calculateFactor($staticShift->shift_from, $staticShift->shift_until, $data['active-shift-date']);

        $activeShift = ActiveShift::create([
            'shift_id'  =>  $staticShift->id,
            'name'  =>  $staticShift->name,
            'date'  =>  $data['active-shift-date'],
            'from'  =>  $staticShift->shift_from,
            'until' =>  $staticShift->shift_until,
            'duration'  =>  $calculations['duration'],
            'factor'    =>  ($calculations['morning'] + $calculations['evening'] + $calculations['night']),
        ]);

        $guards = Guard::whereIn('id', $assignedGuardIds)->get();

        try {
            $activeShift->guards()->attach($guards);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        $request->session()->flash('success', 'Επιτυχής ανάθεση');
        return redirect(route('active-shift.index'));
    }

    public function destroy(ActiveShift $activeShift)
    {
        $activeShift->delete();

        \request()->session()->flash('success', 'Επιτυχής διαγραφή');
        return redirect(route('active-shift.index'));
    }

    public function confirmActiveShiftSupervisor($id)
    {
        $activeShift = ActiveShift::findOrFail($id);

        if ($activeShift->confirmed_supervisor == 1)
        {
            $activeShift->confirmed_supervisor = 0;
            $activeShift->save();
            request()->session()->flash('success', 'Επιτυχής υποβολή');
            return redirect( route('active-shift.index') );
        }

        $activeShift->confirmed_supervisor = 1;
        $activeShift->save();

        request()->session()->flash('success', 'Επιτυχής αλλαγή κατάστασης');
        return redirect( route('active-shift.index') );
    }

    public function confirmActiveShiftSteward($id)
    {
        $activeShift = ActiveShift::findOrFail($id);

        if ($activeShift->confirmed_steward == 1)
        {
            $activeShift->confirmed_steward = 0;
            $activeShift->save();
            request()->session()->flash('success', 'Επιτυχής επιβεβαίωση');
            return redirect( route('active-shift.index') );
        }

        $activeShift->confirmed_steward = 1;
        $activeShift->save();

        request()->session()->flash('success', 'Επιτυχής αλλαγή κατάστασης');
        return redirect( route('active-shift.index') );
    }

    private function fetchData($numberOfGuards)
    {
        switch ($numberOfGuards)
        {
            case 1:
                $data = \request()->validate([
                    'active-shift-date' =>  'required',
                    'shift-id'  =>  'required',
                    'guard1'    =>  'required'
                ]);
                break;
            case 2:
                $data = \request()->validate([
                    'active-shift-date' =>  'required',
                    'shift-id'  =>  'required',
                    'guard1'    =>  'required',
                    'guard2'    =>  'required',
                ]);
                break;
            case 3:
                $data = \request()->validate([
                    'active-shift-date' =>  'required',
                    'shift-id'  =>  'required',
                    'guard1'    =>  'required',
                    'guard2'    =>  'required',
                    'guard3'    =>  'required',
                ]);
                break;
            case 4:
                $data = \request()->validate([
                    'active-shift-date' =>  'required',
                    'shift-id'  =>  'required',
                    'guard1'    =>  'required',
                    'guard2'    =>  'required',
                    'guard3'    =>  'required',
                    'guard4'    =>  'required',
                ]);
                break;
            default:
                $data = \request()->validate([
                    'active-shift-date' =>  'required',
                    'shift-id'  =>  'required',
                    'guard1'    =>  'required',
                ]);
                break;
        }
        return $data;
    }

    private function checkShiftOverlap($assignedGuardIds, $data, $newShiftFrom)
    {
        $overLap = 0;

        foreach ($assignedGuardIds as $id)
        {
            $guard = Guard::findOrFail($id);

            foreach ( $guard->activeShifts()->get() as $existingShift )
            {
                if ( isset($data['active-shift-id']) && ($existingShift->id == $data['active-shift-id']) )
                {
                    continue;
                }

                if ( date('d M y', strtotime($existingShift->date)) == date('d M y', strtotime($data['active-shift-date'])) )
                {
                    if ( ($existingShift->until > $newShiftFrom) || ($existingShift->from == $newShiftFrom) )
                    {
                        $overLap = 1;
                    }
                }
            }
        }
        return $overLap;
    }

    private function calculateFactor($from, $until, $date)
    {
        $start = strtotime($from);

        $end = ( $until < $from )
            ? ( strtotime($until) + 3600 * 24 )
            : strtotime($until);

        $duration = ($end - $start) / 3600; // shift's duration in hours

        $morning_start = strtotime("06:00");
        $morning_end = strtotime("14:00");
        $afternoon_start = strtotime("14:00");
        $afternoon_end = strtotime("22:00");
        $night_start = strtotime("22:00");
        $night_end = strtotime("06:00") + 3600 * 24; // 06:00 of next day, add 3600*24 seconds

        switch ( date('l', strtotime($date)) )
        {
            case 'Saturday':
                $morningFactor = 1;
                $eveningFactor = 1.25;
                $nightFactor = 1.75;
                break;

            case 'Sunday':
                $morningFactor = 1.25;
                $eveningFactor = 1.25;
                $nightFactor = 2;
                break;

            default:
                $morningFactor = 1;
                $eveningFactor = 1;
                $nightFactor = 1.75;
                break;
        }

        $data = [
            'start'     =>  $from,
            'end'       =>  $until,
            'morning'   =>  ($this->intersection( $start, $end, $morning_start, $morning_end, 'm' ) / 3600) * $morningFactor,
            'evening'   =>  ($this->intersection( $start, $end, $afternoon_start, $afternoon_end, 'e' ) / 3600) * $eveningFactor,
            'night'     =>  ($this->intersection( $start, $end, $night_start, $night_end, 'n' ) / 3600) * $nightFactor,
            'duration'  =>  $duration,
            'start_day' =>  date('l', strtotime($date)),
        ];

        return $data;
    }

    private function intersection($s1, $e1, $s2, $e2, $when)
    {
        $midnight = strtotime('24:00');

        if ($e1 < $s2)
        {
            return 0;
        }

        if (   ($e1 > $s2)       // morning shift, ends next day, only morning hours
            && ($e1 > $e2)
            && (($e1 - $s2 - 24 * 3600) > 0)
            && ((($midnight - $s1) / 3600 ) > 0)
            && ((($midnight - $s1) / 3600 ) < 12)
            && $when == 'm'
        )
        {
            $temp = ($e1 - $s2 - 24 * 3600);
            return $temp;
        }
        if ($s1 > $e2)
        {
            return 0;
        }
        if ($s1 < $s2)
        {
            $s1 = $s2;
        }
        if ($e1 > $e2)
        {
            $e1 = $e2;
        }
        return $e1 - $s1;
    }
}
