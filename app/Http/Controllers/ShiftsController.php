<?php

namespace App\Http\Controllers;

use App\DayFrame;
use App\Guard;
use App\Location;
use App\Shift;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasAnyRoles(['admin', 'epitropi']))
        {
            $shifts = Shift::paginate(10);
            return view('shift.index', compact('shifts'));
        }

        $shifts = Shift::whereIn('location_id', $user->locations()->pluck('location_id')->toArray())->paginate(10);
        return view('shift.index', compact('shifts'));
    }

    public function show(Shift $shift)
    {
        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('shift.show', compact('guards', 'shift'));
    }

    public function create()
    {
        $authUser = User::find(Auth::id());

        if (Gate::allows('see-all'))
        {
            $locations = Location::all();
        }
        else
        {
            $locations = $authUser->locations()->get();
        }

        return view('shift.create', compact( 'locations') );
    }

    public function edit(Shift $shift)
    {
        $user = User::find(Auth::id());

        switch ($shift->shift_type)
        {
            case 'Weekdays':
            case 'weekdays':
                $type = 'Καθημερινές';
                break;
            case 'Saturday':
            case 'saturday':
                $type = 'Σάββατο';
                break;
            case 'Sunday':
            case 'sunday':
                $type = 'Κυριακή/Αργία';
                break;
        }

        return view('shift.edit', compact('shift', 'user', 'type'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'location' => 'required',
            'shift-from' => 'required',
            'shift-until' => 'required',
            'number-of-guards' => 'required',
            'shift-frame' => 'required',
            'shift-type' => 'required',
        ]);

        $frameGreekName = DayFrame::where('name', '=', $data['shift-frame'])->value('greek_name');
        $locationGreekName = Location::where('id', '=', $data['location'])->value('name');
        $greekDay = $this->getGreekDay($data['shift-type']);
        $shiftGreekName = $locationGreekName.' '.$greekDay.' '.$frameGreekName;

        if ( auth()->user()->shifts()->create([
            'location_id'  =>  $data['location'],
            'number_of_guards'  =>  $data['number-of-guards'],
            'name'  =>  $shiftGreekName,
            'shift_from'    =>  $data['shift-from'],
            'shift_until'    =>  $data['shift-until'],
            'shift_frame'   =>  $data['shift-frame'],
            'shift_type'    =>  $data['shift-type'],
        ]) )
        {
            $request->session()->flash('success', 'Επιτυχής δημιουργία βάρδιας σε σημείο φύλαξης');
        }
        else
        {
            $request->session()->flash('error', 'Σφάλμα κατά τη δημιουργία');
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
            'shift-frame' => 'required',
            'shift-type' => 'required',
        ]);

        $frameGreekName = DayFrame::where('name', '=', $data['shift-frame'])->value('greek_name');
        $locationGreekName = Location::where('id', '=', $data['location'])->value('name');
        $greekDay = $this->getGreekDay($data['shift-type']);
        $shiftGreekName = $locationGreekName.' '.$greekDay.' '.$frameGreekName;

        if ($shift->update([
            'location_id'  =>  $data['location'],
            'number_of_guards'  =>  $data['number-of-guards'],
            'name'  =>  $shiftGreekName,
            'shift_from'    =>  $data['shift-from'],
            'shift_until'    =>  $data['shift-until'],
            'shift_frame'   =>  $data['shift-frame'],
            'shift_type'    =>  $data['shift-type'],
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
        $shift->delete()
            ? request()->session()->flash('success', 'Επιτυχής διαγραφή')
            : request()->session()->flash('error', 'Σφάλμα κατά τη διαγραφή');

        return redirect('/shift/index');
    }

    private function getGreekDay($englishDay)
    {
        $greekDay = '';

        switch ($englishDay)
        {
            case 'Weekdays':
                $greekDay = 'Καθημερινές';
                break;
            case 'Saturday':
                $greekDay = 'Σάββατο';
                break;
            case 'Sunday':
                $greekDay = 'Κυριακή/Αργία';
                break;
        }

        return $greekDay;
    }
}
