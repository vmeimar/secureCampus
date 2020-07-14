<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Exports\ActiveShiftsExport;
use App\Guard;
use App\Location;
use App\Shift;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
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

        return view('active-shift.index', compact('activeShifts', 'user'));
    }

    public function create(Shift $shift)
    {
        if (!Schema::hasTable('days_of_year'))
        {
            \request()->session()->flash('warning', 'Δεν έχουν οριστεί οι αργίες και οι εργάσιμες ημέρες του έτους.');
            return redirect(route('shift.index'));
        }

        switch ($shift->shift_type)
        {
            case 'Saturday':
                $availableDates = DB::table('days_of_year')
                    ->where('day', 'Saturday')
                    ->get();
                break;
            case 'Sunday':
                $availableDates = DB::table('days_of_year')
                    ->where('day', 'Sunday')
                    ->get();
                break;
            default:
                $availableDates = DB::table('days_of_year')
                    ->whereNotIn('day', ['Saturday', 'Sunday'])
                    ->get();
                break;
        }

        $guards = Guard::where('active', 1)->orderBy('surname', 'asc')->get();
        return view('active-shift.create', compact('shift', 'guards', 'availableDates'));
    }

    public function edit(ActiveShift $activeShift)
    {
        switch (date('l', strtotime($activeShift->date)))
        {
            case 'Saturday':
                $availableDates = DB::table('days_of_year')
                    ->where('day', 'Saturday')
                    ->get();
                break;
            case 'Sunday':
                $availableDates = DB::table('days_of_year')
                    ->where('day', 'Sunday')
                    ->get();
                break;
            default:
                $availableDates = DB::table('days_of_year')
                    ->whereNotIn('day', ['Saturday', 'Sunday'])
                    ->get();
                break;
        }

        $guards = Guard::where('active', 1)->orderBy('surname', 'asc')->get();
        return view('active-shift.edit', compact('activeShift', 'guards', 'availableDates'));
    }

    public function store(Request $request)
    {
        $timeOffset = 10;

        foreach ($request->except(['_token', 'active-shift-date', 'shift-id', 'month']) as $item)
        {
            $assignedGuardIds[] = $item;
        }
        $data = $this->fetchData( count($assignedGuardIds) );

        $staticShift = Shift::findOrFail($data['shift-id']);

        $overLap = $this->checkShiftOverlap($assignedGuardIds, $data);

        if ($overLap)
        {
            $request->session()->flash('warning', 'Δεν ανατέθηκε. Υπάρχει σύγκρουση ωραρίου.');
            return redirect(route('active-shift.index'));
        }

        $activeShiftData = explode('|', $data['active-shift-date']);  // DATE | IS_HOLIDAY
        $date = $activeShiftData[0];
        $isHoliday = $activeShiftData[1];
        $dayFrameArray = $this->calculateFrames($staticShift->shift_from, $staticShift->shift_until, $date, $timeOffset);
        $shiftFactor = $this->assignFactors($dayFrameArray);

        $first_key = array_key_first($dayFrameArray);
        $last_key = array_key_last($dayFrameArray);

        $shiftFrom = $dayFrameArray[$first_key]['start_frame'];
        $shiftUntil = $dayFrameArray[$last_key]['end_frame'];
        $shiftDuration = strtotime($shiftUntil) - strtotime($shiftFrom);

        $activeShift = ActiveShift::create([
            'shift_id'  =>  $staticShift->id,
            'location_id'  =>  $staticShift->location_id,
            'name'  =>  $staticShift->name,
            'date'  =>  $date,
            'from'  =>  $shiftFrom,
            'until' =>  $shiftUntil,
            'duration'  =>  $shiftDuration / 3600,  // IN HOURS
            'factor'    =>  $shiftFactor,
            'is_holiday' => $isHoliday,
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

    public function update(ActiveShift $activeShift)
    {
        $timeOffset = 10;

        foreach (request()->except(['_token', '_method', 'active-shift-date', 'shift-id', 'active-shift-comments', 'month']) as $item)
        {
            $assignedGuardIds[] = $item;
        }

        $data = request()->all();
        $data['active-shift-id'] = $activeShift->id;
        $overLap = $this->checkShiftOverlap($assignedGuardIds, $data);

        if ($overLap)
        {
            request()->session()->flash('warning', 'Δεν αποθηκεύτηκε. Υπάρχει σύγκρουση ωραρίου.');
            return redirect(route('active-shift.index'));
        }

        $activeShiftData = explode('|', $data['active-shift-date']);  // DATE | IS_HOLIDAY
        $date = $activeShiftData[0];
        $isHoliday = $activeShiftData[1];
        $dayFrameArray = $this->calculateFrames($activeShift->from, $activeShift->until, $date, $timeOffset);
        $shiftFactor = $this->assignFactors($dayFrameArray);

        $first_key = array_key_first($dayFrameArray);
        $last_key = array_key_last($dayFrameArray);

        $shiftFrom = $dayFrameArray[$first_key]['start_frame'];
        $shiftUntil = $dayFrameArray[$last_key]['end_frame'];
        $shiftDuration = strtotime($shiftUntil) - strtotime($shiftFrom);

        if (! $activeShift->update([
            'name'  =>  $activeShift->name,
            'date'  =>  $date,
            'from'  =>  $shiftFrom,
            'until' =>  $shiftUntil,
            'comments'  =>  $data['active-shift-comments'],
            'duration'  =>  $shiftDuration / 3600,   // IN HOURS
            'factor'    =>  $shiftFactor,
            'is_holiday' => $isHoliday,
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
            request()->session()->flash('success', 'Επιτυχής αλλαγή κατάστασης');
            return redirect( route('active-shift.index') );
        }

        $activeShift->confirmed_supervisor = 1;
        $activeShift->save();

        request()->session()->flash('success', 'Επιτυχής υποβολή');
        return redirect( route('active-shift.index') );
    }

    public function confirmAllSupervisor(Location $location, Request $request)
    {
        $data = $request->all();
        $locationId = $location->id;
        $month = $data['month'];
        $allActiveShifts = $location->activeShifts()->get();

        if ( !isset($allActiveShifts) or is_null($allActiveShifts) )
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν βάρδιες προς υποβολή.');
            return redirect()->back();
        }

        foreach ($allActiveShifts as $activeShift)
        {
            if ( (($activeShift->confirmed_steward == 1) and (date('m', strtotime($activeShift->from)) == $month) ) or ($month == 'all') )
            {
                $activeShifts[] = $activeShift;

                if ($activeShift->confirmed_supervisor == 0)
                {
                    $activeShift->update(
                        ['confirmed_supervisor' => 1]
                    );
                }
            }
        }

        \request()->session()->flash('success', 'Επιτυχής μαζική υποβολή.');
        return view('active-shift.custom-index', compact('activeShifts', 'locationId', 'month'));
//        return redirect(route('active-shift.index'));
    }

    public function confirmActiveShiftSteward($id)
    {
        $activeShift = ActiveShift::findOrFail($id);

        if ($activeShift->confirmed_steward == 1)
        {
            $activeShift->confirmed_steward = 0;
            $activeShift->save();
            request()->session()->flash('success', 'Επιτυχής αλλαγή κατάστασης');
            return redirect( route('active-shift.index') );
        }

        $activeShift->confirmed_steward = 1;
        $activeShift->save();

        request()->session()->flash('success', 'Επιτυχής επιβεβαίωση');
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

    private function checkShiftOverlap($assignedGuardIds, $data)
    {
        $overLap = 0;

        if ( isset($data['active-shift-id']) )
        {
            $activeShift = ActiveShift::find($data['active-shift-id']);
        }

        foreach ($assignedGuardIds as $guardId)
        {
            $guard = Guard::findOrFail($guardId);

            foreach ( $guard->activeShifts()->get() as $guardShift )
            {
                $guardShiftFrom = date('d-m-Y H:i:s', strtotime($guardShift->from));
                $guardShiftUntil = date('d-m-Y H:i:s', strtotime($guardShift->until));

                if ( isset($activeShift) and ($guardShift->id == $activeShift->id) ) continue;

                $dateHoliday = explode('|', $data['active-shift-date']);
                $staticDate = $dateHoliday[0];

                $staticShift = Shift::find($data['shift-id']);
                $checkFrom = date('d-m-Y H:i:s', strtotime($staticDate.' '.$staticShift->shift_from));
                $checkUntil = date('d-m-Y H:i:s', strtotime($staticDate.' '.$staticShift->shift_until));

                if ( ( (strtotime($checkFrom) >= strtotime($guardShiftFrom)) and (strtotime($checkFrom) <= strtotime($guardShiftUntil)) )
                    or ( (strtotime($checkUntil) >= strtotime($guardShiftFrom)) and (strtotime($checkUntil) <= strtotime($guardShiftUntil)) ) )
                {
                    $overLap = 1;
                }
            }
        }
        return $overLap;
    }

    private function calculateFrames($from, $until, $date, $offset)
    {
        $start = strtotime($from);

        if ( $start > strtotime($until) )
        {
            $end = strtotime($until." +1 day");
        }
        else
        {
            $end = strtotime($until);
        }

        $duration = ($end - $start) / 60;     //IN MINUTES

        $startTime = date('H:i:s', strtotime($from));
        $startDate = date('Y-m-d', strtotime($date));
        $startDateTime = date('Y-m-d H:i:s', strtotime($startDate.$startTime));
        $endDateTime = date('Y-m-d H:i:s', strtotime($startDateTime." +".$duration." minutes"));

        $quantum = $startDateTime;
        $dayFrameArray = [];

        $frames = DB::table('day_frames')->get()->toArray();

        while ($quantum < $endDateTime)
        {
            $quantumDate = date('Y-m-d', strtotime($quantum));

            foreach ($frames as $frame)
            {
                $startFrame = date('Y-m-d H:i:s', strtotime($startDate.$frame->start_frame));
                $endFrame = date('Y-m-d H:i:s', strtotime($startFrame." +8 hours"));

                if ( strtotime($quantum) >= strtotime($endFrame) )
                {
                    $startFrame = date('Y-m-d H:i:s', strtotime($quantumDate.$frame->start_frame));
                    $endFrame = date('Y-m-d H:i:s', strtotime($startFrame." +8 hours"));
                }

                if ( (strtotime($quantum) >= strtotime($startFrame)) && (strtotime($quantum) < strtotime($endFrame)) )
                {
                    $dayFrameArray[] = [
                        'start_frame'  =>  $quantum,
                        'end_frame'  =>  date('Y-m-d H:i:s', strtotime($quantum." +".$offset." minutes")),
                        'frame'     =>  $frame->name,
                    ];
                }
            }
            $quantum = date('Y-m-d H:i:s', strtotime($quantum." +".$offset." minutes"));
        }
        return $dayFrameArray;
    }

    private function assignFactors($dayFrameArray)
    {
        $previousFrame = null;
        $frameStart = null;
        $frameEnd = null;
        $frameFactor = null;

        foreach ($dayFrameArray as $key => $value)
        {
            $newarray[$value['frame']][$value['start_frame']] = $value['end_frame'];
        }

        foreach ($newarray as $key => $value)
        {
            $frame  = $key;     //  FRAME NAME (morning, evening, night)
            $tempFrame = $newarray[$key];
            $previousDay = null;

            foreach ($tempFrame as $tempKey => $tempValue)
            {
                $tempFrameStart = $tempKey;
                $tempFrameEnd = $tempValue;
                $tempFrameDuration = strtotime($tempFrameEnd) - strtotime($tempFrameStart);     // IN SECONDS

                $shiftDay = DB::table('days_of_year')
                    ->where('date', date('Y-m-d', strtotime($tempFrameStart)))
                    ->first();

                switch ( lcfirst( date('l', strtotime($tempFrameStart))) )
                {
                    case 'saturday':
                        $day = 'saturday';
                        break;
                    case 'sunday':
                        $day = 'sunday';
                        break;
                    default:
                        $day = 'weekdays';
                }

                if ($shiftDay->is_holiday)
                {
                    $factor = DB::table('factors')
                        ->where('name', 'sunday_'.$frame.'_rate')
                        ->value('rate');
                }
                else
                {
                    $factor = DB::table('factors')
                        ->where('name', $day.'_'.$frame.'_rate')
                        ->value('rate');
                }

                $tempFactor = $factor * $tempFrameDuration;     // FOR SECONDS
                $frameFactor += $tempFactor;
            }
        }

        return ($frameFactor / 3600);
    }

    public function exportByLocation(Location $location)
    {
        $activeShifts = $location->activeShifts()->get();

        if ( is_null($activeShifts) or !isset($activeShifts) )
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν βάρδιες για το σημέιο φύλαξης.');
            return redirect()->back();
        }

        return Excel::download(new ActiveShiftsExport(collect($activeShifts)), 'Κτήριο '.$location->name.'.xlsx');
    }

    public function showByLocation(Request $request)
    {
        $activeShifts = [];

        $data = $request->validate([
            'location'  =>  'required',
            'month'     =>  'required',
        ]);

        $locationId = $data['location'];
        $allActiveShifts = ActiveShift::all();
        $month = $data['month'];

        foreach ($allActiveShifts as $row)
        {
            if ( ($row->shift->location->id == $locationId) and ($row->confirmed_steward == 1) )
            {
                if ( ($month != date('m', strtotime($row->from))) and ($month != 'all') ) continue;

                $activeShifts[] = $row;
            }
        }
        if ($activeShifts == [])
        {
            $request->session()->flash('warning', 'Δεν υπάρχουν ενεργές βάρδιες για αυτό το σημείο φύλαξης.');
            return redirect(route('active-shift.index'));
        }

        return view('active-shift.custom-index', compact('activeShifts', 'locationId', 'month'));
    }

    public function exportPdf(Location $location, Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $month = $data['month'];
        $allActiveShifts = $location->activeShifts()->get();

        if ( !isset($allActiveShifts) or is_null($allActiveShifts) )
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν βάρδιες για εξαγωγή.');
            return redirect()->back();
        }


        if ($month == 'all')
        {
            $from = date('d/m/Y', strtotime('Jan 1'));
            $to = date('d/m/Y', strtotime('Dec 31'));
        }
        else
        {
            // Use mktime() and date() function to
            // convert number to month name
            $month_name = date("F", mktime(0, 0, 0, $month, 10));

            $from = date('01/m/Y', strtotime($month_name));
            $to = date('t/m/Y', strtotime($month_name));
        }

        $guards = Guard::all();

        foreach ($guards as $guard)
        {
            foreach ($guard->activeShifts()->get() as $activeShift)
            {
                if ( (($month == date('m', strtotime($activeShift->from))) or ($month == 'all') ) and
                    ( $activeShift->location_id == $location->id ) and
                    ( $activeShift->confirmed_supervisor == 1 ) and
                    ( $activeShift->confirmed_steward == 1 ) )
                {
                    $activeShifts[$guard->surname.' '.$guard->name][] = $activeShift;
                }
            }
        }

        if ( !isset($activeShifts) or is_null($activeShifts) )
        {
            $request->session()->flash('warning', 'Δεν υπάρχουν επιβεβαιωμένες βάρδιες που έχουν υποβληθεί για εξαγωγή.');
            return redirect(route('active-shift.index'));
        }

        $pdf = PDF::loadView('/active-shift/export-pdf', compact('location', 'user', 'from', 'to', 'activeShifts'));
        return $pdf->download('Κτήριο '.$location->name.'.pdf');

    }

    /**
     * AJAX for fetching active shifts
     */
        function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $shiftId = $request->get('shiftId');

        $shift = Shift::find($shiftId);

        switch ($shift->shift_type)
        {
            case 'Saturday':
                $daysOfYear = DB::table('days_of_year')
                    ->where('day', 'Saturday')
                    ->get();
                break;
            case 'Sunday':
                $daysOfYear = DB::table('days_of_year')
                    ->where('day', 'Sunday')
                    ->get();
                break;
            default:
                $daysOfYear = DB::table('days_of_year')
                    ->whereNotIn('day', ['Saturday', 'Sunday'])
                    ->get();
                break;
        }

        foreach ($daysOfYear as $item)
        {
            if ($value == date('m', strtotime($item->date)))
            {
                $data[] = $item;
            }
        }

        $output = '<option value="" disabled>Επιλέξτε Ημέρα</option>';

        foreach ($data as $row)
        {
            switch ($row->day)
            {
                case 'Monday':
                    $greekDay = 'Δευτέρα';
                    break;
                case 'Tuesday':
                    $greekDay = 'Τρίτη';
                    break;
                case 'Wednesday':
                    $greekDay = 'Τετάρτη';
                    break;
                case 'Thursday':
                    $greekDay = 'Πέμπτη';
                    break;
                case 'Friday':
                    $greekDay = 'Παρασκευή';
                    break;
                case 'Saturday':
                    $greekDay = 'Σάββατο';
                    break;
                case 'Sunday':
                    $greekDay = 'Κυριακή';
                    break;
            }

            $output .= '<option value="'.$row->date.'|'.$row->is_holiday.'">'.$greekDay.' '.date('d-m-Y', strtotime($row->date)).'</option>';
        }
        echo $output;
    }
}
