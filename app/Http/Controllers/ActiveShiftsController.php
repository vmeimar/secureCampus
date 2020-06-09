<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Throwable;

class ActiveShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $activeShifts = ActiveShift::latest()->paginate(10);
        return view('active-shift.index', compact('activeShifts'));
    }

    public function create(Shift $shift)
    {
        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('active-shift.create', compact('shift', 'guards'));
    }

    public function edit(ActiveShift $activeShift)
    {
//        dd($activeShift->guards()->get()->toArray()[0]['name']);
        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('active-shift.edit', compact('activeShift', 'guards'));
    }

    public function update(ActiveShift $activeShift)
    {
//        dd(request()->get('active-shift-comments'));

//        dd(request()->all());
        foreach (request()->except(['_token', '_method', 'active-shift-date', 'shift-id', 'active-shift-comments']) as $item)
        {
            $assignedGuardIds[] = $item;
        }

        $data = $this->fetchData( count($assignedGuardIds) );

        dd($data);

        $overLap = $this->checkShiftOverlap($assignedGuardIds, $data, $activeShift->from);

        if ($overLap)
        {
            request()->session()->flash('warning', 'Δεν αποθηκεύτηκε. Υπάρχει σύγκρουση ωραρίου.');
            return redirect(route('active-shift.index'));
        }

        dd($data);

//        $activeShift->update([
//            'name'  =>  $activeShift->name,
//            'date'  =>  $data['active-shift-date'],
//            'from'  =>  $activeShift->shift_from,
//            'until' =>  $staticShift->shift_until,
//        ]);
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

        $activeShift = ActiveShift::create([
            'name'  =>  $staticShift->name,
            'date'  =>  $data['active-shift-date'],
            'from'  =>  $staticShift->shift_from,
            'until' =>  $staticShift->shift_until,
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
        $activeShift->guards()->detach();
        $activeShift->delete();

        \request()->session()->flash('success', 'Επιτυχής διαγραφή');
        return redirect(route('active-shift.index'));
    }

    public function confirmActiveShift($id)
    {
        $activeShift = ActiveShift::findOrFail($id);

        if ($activeShift->confirmed == 1)
        {
            $activeShift->confirmed = 0;
            $activeShift->save();
            request()->session()->flash('success', 'Επιτυχής αλλαγή κατάστασης');
            return redirect( route('active-shift.index') );
        }

        $activeShift->confirmed = 1;
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
                    'shift-id'  =>  'required',  //     HERE
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
}
