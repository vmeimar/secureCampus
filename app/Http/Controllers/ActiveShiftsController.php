<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Factor;
use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function showByLocation(Request $request)
    {
        $activeShifts = [];

        $data = $request->validate([
            'location'  =>  'required',
        ]);

        $locationId = $data['location'];
        $allActiveShifts = ActiveShift::all();

        foreach ($allActiveShifts as $row)
        {
            if ( $row->shift->location->id == $locationId)
            {
                $activeShifts[] = $row;
            }
        }

        if ($activeShifts == [])
        {
            $request->session()->flash('warning', 'Δεν υπάρχουν ενεργές βάρδιες για αυτό το σημείο φύλαξης.');
            return redirect(route('active-shift.index'));
        }

        return view('active-shift.custom-index', compact('activeShifts'));
    }

    public function create(Shift $shift)
    {
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

        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
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

        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();
        return view('active-shift.edit', compact('activeShift', 'guards', 'availableDates'));
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

        $activeShiftData = explode('|', $data['active-shift-date']);  // DATE | IS_HOLIDAY

        $dayFrameArray = $this->calculateFrames($staticShift->shift_from, $staticShift->shift_until, $activeShiftData[0]);
        $this->assignFactors($dayFrameArray);


//        $calculations = $this->calculateFactor($staticShift->shift_from, $staticShift->shift_until, $activeShiftData[0], $activeShiftData[1]);   // IS_HOLIDAY

        $activeShift = ActiveShift::create([
            'shift_id'  =>  $staticShift->id,
            'name'  =>  $staticShift->name,
            'date'  =>  $activeShiftData[0],    // DATE
            'from'  =>  $staticShift->shift_from,
            'until' =>  $staticShift->shift_until,
//            'duration'  =>  $calculations['duration'],
//            'factor'    =>  ($calculations['morning'] + $calculations['evening'] + $calculations['night']),
            'is_holiday' => $activeShiftData[1],
        ]);

        $guards = Guard::whereIn('id', $assignedGuardIds)->get();

        try {
            $activeShift->guards()->attach($guards);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        $hourAnalysis = $this->hoursAnalysis($activeShift);

        $activeShift->update([
            'duration'  =>  $hourAnalysis['duration'],
            'factor'    =>  $hourAnalysis['morning'] + $hourAnalysis['evening'] + $hourAnalysis['night'],
        ]);

        $request->session()->flash('success', 'Επιτυχής ανάθεση');
        return redirect(route('active-shift.index'));
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


        $activeShiftData = explode('|', $data['active-shift-date']);  // DATE | IS_HOLIDAY
//        $calculations = $this->calculateFactor($activeShift->from, $activeShift->until, $activeShiftData[0], $activeShiftData[1]);
        $hourAnalysis = $this->hoursAnalysis($activeShift);

        if (! $activeShift->update([
            'name'  =>  $activeShift->name,
            'date'  =>  $activeShiftData[0],
            'from'  =>  $activeShift->from,
            'until' =>  $activeShift->until,
            'comments'  =>  $data['active-shift-comments'],
            'duration'  =>  $hourAnalysis['duration'],
            'factor'    =>  ($hourAnalysis['morning'] + $hourAnalysis['evening'] + $hourAnalysis['night']),
            'is_holiday' => $activeShiftData[1],
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

    private function calculateFrames($from, $until, $date)
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

                if ( strtotime($quantum) >= strtotime($endFrame))
                {
                    $startFrame = date('Y-m-d H:i:s', strtotime($quantumDate.$frame->start_frame));
                    $endFrame = date('Y-m-d H:i:s', strtotime($startFrame." +8 hours"));
                }

                if ( (strtotime($quantum) >= strtotime($startFrame)) && (strtotime($quantum) < strtotime($endFrame)) )
                {
                    $dayFrameArray[] = [
                        'datetime'  =>  $quantum,
                        'frame'     =>  $frame->name
                    ];
                }
            }
            $quantum = date('Y-m-d H:i:s', strtotime($quantum." +10 minutes"));
        }
        return $dayFrameArray;
    }

    private function assignFactors($dayFrameArray)
    {
        $temp = [
            'start' =>  $dayFrameArray[0]['datetime'],
            'frame' =>  $dayFrameArray[0]['frame'],
        ];

        foreach ($dayFrameArray as $item)
        {
            if ( $item['frame'] == $temp['frame'] ) continue;

            $temp[] = [
                'start' =>  $item['datetime'],
                'frame' =>  $item['frame'],
            ];
        }

        dd($temp);
    }

//    private function hoursAnalysis(ActiveShift $activeShift)
//    {
//        $morningStart = strtotime('06:00');
//        $eveningStart = strtotime('14:00');
//        $nightStart = strtotime('22:00');
//        $nextMorning = $morningStart + 3600 * 24;
//
//        $morningHours = 0;
//        $eveningHours = 0;
//        $nightHours = 0;
//
//        $start = strtotime($activeShift->from);
//        $end = strtotime($activeShift->until);
//
//        if ($start > $end)  // next day
//        {
//            $end += 24 * 3600;
//
//            if ($start < $nightStart)
//            {
//                $eveningHours = ($nightStart - $start) / 3600;
//            }
//
//            $nightHours = (($nextMorning - $start) / 3600) - $eveningHours;
//
//            if ($end > $nextMorning)
//            {
//                $morningHours = ($end - $nextMorning) / 3600;
//            }
//
//            $hoursAnalysis = [
//                'morning'   =>  $morningHours,
//                'evening'   =>  $eveningHours,
//                'night'     =>  $nightHours,
//            ];
//        }
//        else
//        {
//            if ($start >= $eveningStart)
//            {
//                if ($end > $nightStart)
//                {
//                    $nightHours = ($end - $nightStart) / 3600;
//                }
//
//                if ($end > $eveningStart)
//                {
//                    $eveningHours = (($end - $eveningStart) / 3600) - $nightHours - (($start - $eveningStart) / 3600);
//                }
//
//                $hoursAnalysis = [
//                    'morning'   =>  $morningHours,
//                    'evening'   =>  $eveningHours,
//                    'night'     =>  $nightHours,
//                ];
//            }
//            else
//            {
//                if ($end > $nightStart)
//                {
//                    $nightHours = ($end - $nightStart) / 3600;
//                }
//
//                if ($end > $eveningStart)
//                {
//                    $eveningHours = (($end - $eveningStart) / 3600) - $nightHours;
//                }
//
//                if ($start < $morningStart)
//                {
//                    $nightHours += ($morningStart - $start) / 3600;
//                }
//
//                $morningHours = ($eveningStart - $start) / 3600;
//
//                $hoursAnalysis = [
//                    'morning'   =>  $morningHours,
//                    'evening'   =>  $eveningHours,
//                    'night'     =>  $nightHours,
//                ];
//            }
//        }
//
//        if (!$activeShift->is_holiday)
//        {
//            switch ( date('l', strtotime($activeShift->date)) )
//            {
//                case 'Saturday':
//                    $morningFactor = Factor::where('name', 'saturday_morning_rate')->value('rate');
//                    $eveningFactor = Factor::where('name', 'saturday_morning_rate')->value('rate');
//                    $nightFactor = Factor::where('name', 'saturday_night_rate')->value('rate');
//                    break;
//
//                case 'Sunday':
//                    $morningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//                    $eveningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//                    $nightFactor = Factor::where('name', 'sunday_night_rate')->value('rate');
//                    break;
//
//                default:
//                    $morningFactor = Factor::where('name', 'weekdays_morning_rate')->value('rate');
//                    $eveningFactor = Factor::where('name', 'weekdays_morning_rate')->value('rate');
//                    $nightFactor = Factor::where('name', 'weekdays_night_rate')->value('rate');
//                    break;
//            }
//        }
//        else
//        {
//            $morningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//            $eveningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//            $nightFactor = Factor::where('name', 'sunday_night_rate')->value('rate');
//        }
//
//        $duration = ($end - $start) / 3600; // activeShift's duration in hours
//
//        $data = [
//            'morning'   =>  $hoursAnalysis['morning'] * $morningFactor,
//            'evening'   =>  $hoursAnalysis['evening'] * $eveningFactor,
//            'night'     =>  $hoursAnalysis['night'] * $nightFactor,
//            'duration'  =>  $duration,
//        ];
//
//        return $data;
//    }

//    private function calculateFactor($from, $until, $date, $isHoliday)
//    {
//        $start = strtotime($from);
//
//        $end = ( $until < $from )
//            ? ( strtotime($until) + 3600 * 24 )
//            : strtotime($until);
//
//        $duration = ($end - $start) / 3600; // shift's duration in hours
//
//        $morning_start = strtotime("06:00");
//        $morning_end = strtotime("14:00");
//        $afternoon_start = strtotime("14:00");
//        $afternoon_end = strtotime("22:00");
//        $night_start = strtotime("22:00");
//        $night_end = strtotime("06:00") + 3600 * 24; // 06:00 of next day, add 3600*24 seconds
//
//        switch ( date('l', strtotime($date)) )
//        {
//            case 'Saturday':
//                $morningFactor = Factor::where('name', 'saturday_morning_rate')->value('rate');
//                $eveningFactor = Factor::where('name', 'saturday_morning_rate')->value('rate');
//                $nightFactor = Factor::where('name', 'saturday_night_rate')->value('rate');
//                break;
//
//            case 'Sunday':
//                $morningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//                $eveningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//                $nightFactor = Factor::where('name', 'sunday_night_rate')->value('rate');
//                break;
//
//            default:
//                $morningFactor = Factor::where('name', 'weekdays_morning_rate')->value('rate');
//                $eveningFactor = Factor::where('name', 'weekdays_morning_rate')->value('rate');
//                $nightFactor = Factor::where('name', 'weekdays_night_rate')->value('rate');
//                break;
//        }
//
//        if ($isHoliday)
//        {
//            $morningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//            $eveningFactor = Factor::where('name', 'sunday_morning_rate')->value('rate');
//            $nightFactor = Factor::where('name', 'sunday_night_rate')->value('rate');
//        }
//
//        $data = [
//            'start'     =>  $from,
//            'end'       =>  $until,
//            'morning'   =>  ($this->intersection( $start, $end, $morning_start, $morning_end, 'm' ) / 3600) * $morningFactor,
//            'evening'   =>  ($this->intersection( $start, $end, $afternoon_start, $afternoon_end, 'e' ) / 3600) * $eveningFactor,
//            'night'     =>  ($this->intersection( $start, $end, $night_start, $night_end, 'n' ) / 3600) * $nightFactor,
//            'duration'  =>  $duration,
//            'start_day' =>  date('l', strtotime($date)),
//        ];
//
//        return $data;
//    }

//    private function intersection($s1, $e1, $s2, $e2, $when)
//    {
//        $midnight = strtotime('24:00');
//
//        if ($e1 < $s2)
//        {
//            return 0;
//        }
//
//        if (   ($e1 > $s2)       // morning shift, ends next day, only morning hours
//            && ($e1 > $e2)
//            && (($e1 - $s2 - 24 * 3600) > 0)
//            && ((($midnight - $s1) / 3600 ) > 0)
//            && ((($midnight - $s1) / 3600 ) < 12)
//            && $when == 'm'
//        )
//        {
//            $temp = ($e1 - $s2 - 24 * 3600);
//            return $temp;
//        }
//        if ($s1 > $e2)
//        {
//            return 0;
//        }
//        if ($s1 < $s2)
//        {
//            $s1 = $s2;
//        }
//        if ($e1 > $e2)
//        {
//            $e1 = $e2;
//        }
//        return $e1 - $s1;
//    }

    /**
     * AJAX for fetching active shifts
     */
    //    function fetch(Request $request)
//    {
//        $select = $request->get('select');
//        $value = $request->get('value');
//        $dependent = $request->get('dependent');
//
//        $activeShifts = ActiveShift::all();
//
//        foreach ($activeShifts as $activeShift)
//        {
//            if ($activeShift->shift->location->id == $value)
//            {
//                $data[] = $activeShift;
//            }
//        }
//
//        $output = '<option value="">Select Shift</option>';
//
//        foreach ($data as $row)
//        {
//            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
//        }
//
//        echo $output;
//    }
}
