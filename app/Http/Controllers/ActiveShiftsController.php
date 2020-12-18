<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Company;
use App\Exports\ActiveShiftsExport;
use App\Guard;
use App\Location;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
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

        $monthsYears = $this->getMonthsYears();

        if (!$monthsYears)
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν ανατεθειμένες βάρδιες.');
            return redirect(route('shift.index'));
        }

        if ($user->hasAnyRoles(['doy']))
        {
            $activeShifts = ActiveShift::where('confirmed_supervisor', 1)->latest()->paginate(10);
        }
        elseif ($user->hasRole('admin'))
        {
            $activeShifts = ActiveShift::latest()->paginate(15);
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

        return view('active-shift.index', compact('activeShifts', 'user', 'monthsYears'));
    }

    public function create(Shift $shift)
    {
        if (!Schema::hasTable('days_of_year'))
        {
            \request()->session()->flash('warning', 'Δεν έχουν οριστεί οι αργίες και οι εργάσιμες ημέρες του έτους.');
            return redirect(route('shift.index'));
        }

        $guards = Guard::where('active', 1)->orderBy('surname', 'asc')->get();
        return view('active-shift.create', compact('shift', 'guards'));
    }

    public function edit(ActiveShift $activeShift)
    {
        $guards = Guard::where('active', 1)->orderBy('surname', 'asc')->get();
        return view('active-shift.edit', compact('activeShift', 'guards'));
    }

    public function store(Request $request)
    {
        $timeOffset = 10;
        $absent = 0;
        $comments = null;

        foreach ($request->except(['_token', 'active-shift-date', 'shift-id', 'month']) as $item)
        {
            $assignedGuardIds[] = $item;
        }

        $data = $request->validate([
            'active-shift-date' =>  'required',
            'shift-id'  =>  'required',
        ]);

        $staticShift = Shift::findOrFail($data['shift-id']);

        $overLap = $this->checkShiftOverlap($assignedGuardIds, $data);

        if ($overLap)
        {
            $request->session()->flash('warning', 'Δεν ανατέθηκε. Υπάρχει σύγκρουση ωραρίου.');
            return redirect(route('active-shift.index'));
        }

        $dayFrameArray = $this->calculateFrames($staticShift->shift_from, $staticShift->shift_until, $data['active-shift-date'], $timeOffset);
        $factorData = $this->assignFactors($dayFrameArray);

        $first_key = array_key_first($dayFrameArray);
        $last_key = array_key_last($dayFrameArray);

        $shiftFrom = $dayFrameArray[$first_key]['start_frame'];
        $shiftUntil = $dayFrameArray[$last_key]['end_frame'];
        $shiftDuration = strtotime($shiftUntil) - strtotime($shiftFrom);

        $i = 0;

        foreach ($assignedGuardIds as $assignedGuardId)
        {
            if ($assignedGuardId == 'absent')
            {
                $absent += $shiftDuration / 3600;
                $comments = 'Απουσία φύλακα στη βάρδια';

                $absentGuardId = $this->findOrCreateAbsentGuard();
                $assignedGuardIds[$i] = strval($absentGuardId);
            }
            $i++;
        }

        /**
         *  Partial Absence Start
         */
//        if ( !is_null($request['hours']) and isset($request['hours']) and ($request['hours'] > 0) )
//        {
//            $absent = $request['hours'];
//            $comments = 'Η φύλαξη δεν πραγματοποιήθηκε για '.$absent.' ώρες από τις '.($shiftDuration/3600).' της συνολικής βάρδιας.';
//        }
        /**
         * Partial Absence End
         */

        $activeShift = ActiveShift::create([
            'shift_id'  =>  $staticShift->id,
            'location_id'  =>  $staticShift->location_id,
            'name'  =>  $staticShift->name,
            'date'  =>  date('Y-m-d', strtotime($data['active-shift-date'])),
            'from'  =>  $shiftFrom,
            'until' =>  $shiftUntil,
            'duration'  =>  $shiftDuration / 3600,  // IN HOURS
            'absent'  =>  $absent,
            'comments'  =>  $comments,
            'weekday_morning'   =>  $factorData['weekday_morning'],
            'weekday_evening'   =>  $factorData['weekday_evening'],
            'weekday_night'   =>  $factorData['weekday_night'],
            'holiday_morning'   =>  $factorData['holiday_morning'],
            'holiday_evening'   =>  $factorData['holiday_evening'],
            'holiday_night'   =>  $factorData['holiday_night'],
            'factor'    =>  $factorData['frame_factor'],
            'is_holiday' => $factorData['is_holiday'],
        ]);

        $guards = Guard::whereIn('id', $assignedGuardIds)->get();

        try {
            $activeShift->guards()->attach($guards);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        $request->session()->flash('success', 'Επιτυχής ανάθεση.');
        return redirect(route('active-shift.index'));
    }

    public function update(ActiveShift $activeShift)
    {
        $timeOffset = 10;
        $absent = null;

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

        $dayFrameArray = $this->calculateFrames($activeShift->from, $activeShift->until, $data['active-shift-date'], $timeOffset);
        $factorData = $this->assignFactors($dayFrameArray);

        $first_key = array_key_first($dayFrameArray);
        $last_key = array_key_last($dayFrameArray);

        $shiftFrom = $dayFrameArray[$first_key]['start_frame'];
        $shiftUntil = $dayFrameArray[$last_key]['end_frame'];
        $shiftDuration = strtotime($shiftUntil) - strtotime($shiftFrom);

        /**
         * Partial Absence Start
         */
//        if ( !is_null($data['hours']) and isset($data['hours']) and ($data['hours'] > 0) )
//        {
//            $absent = $data['hours'];
//        }
        /**
         * Partial Absence End
         */

        $i = 0;

        foreach ($assignedGuardIds as $assignedGuardId)
        {
            if ($assignedGuardId == 'absent')
            {
                $absent += $shiftDuration / 3600;
                $absentGuardId = $this->findOrCreateAbsentGuard();
                $assignedGuardIds[$i] = strval($absentGuardId);
            }
            $i++;
        }

        if (! $activeShift->update([
            'name'  =>  $activeShift->name,
            'date'  =>  date('Y-m-d', strtotime($data['active-shift-date'])),
            'from'  =>  $shiftFrom,
            'until' =>  $shiftUntil,
            'comments'  =>  $data['active-shift-comments'],
            'duration'  =>  $shiftDuration / 3600,   // IN HOURS
            'absent'  =>  $absent,
            'weekday_morning'   =>  $factorData['weekday_morning'],
            'weekday_evening'   =>  $factorData['weekday_evening'],
            'weekday_night'   =>  $factorData['weekday_night'],
            'holiday_morning'   =>  $factorData['holiday_morning'],
            'holiday_evening'   =>  $factorData['holiday_evening'],
            'holiday_night'   =>  $factorData['holiday_night'],
            'factor'    =>  $factorData['frame_factor'],
            'is_holiday' => $factorData['is_holiday'],
        ]))
        {
            request()->session()->flash('error', 'Σφάλμα κατά την αποθήκευση.');
            return redirect(route('active-shift.index'));
        }

        $guards = Guard::whereIn('id', $assignedGuardIds)->get();

        try {
            $activeShift->guards()->sync($guards);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        request()->session()->flash('success', 'Επιτυχής αποθήκευση.');
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
            request()->session()->flash('success', 'Η Βάρδια έχει ήδη υποβληθεί επιτυχώς.');
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
        $year = $data['year'];
        $allActiveShifts = $location->activeShifts()->get();

        if ( !isset($allActiveShifts) or is_null($allActiveShifts) )
        {
            $request->session()->flash('warning', 'Δεν υπάρχουν βάρδιες προς υποβολή.');
            return redirect()->back();
        }

        foreach ($allActiveShifts as $activeShift)
        {
            if ( ((date('m', strtotime($activeShift->from)) == $month) or ($month == 'all'))
                and ((date('Y', strtotime($activeShift->from)) == $year) or ($year == 'all')) )
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

       $request->session()->flash('success', 'Επιτυχής μαζική υποβολή.');
        return view('active-shift.show-by-location', compact('activeShifts', 'locationId', 'month', 'year'));
    }

    /**
     *  Extra layer of shift confirmation. Currently inactive.
     */
//    public function confirmActiveShiftSteward($id)
//    {
//        $activeShift = ActiveShift::findOrFail($id);
//
//        if ($activeShift->confirmed_steward == 1)
//        {
//            $activeShift->confirmed_steward = 0;
//            $activeShift->save();
//            request()->session()->flash('success', 'Επιτυχής αλλαγή κατάστασης');
//            return redirect( route('active-shift.index') );
//        }
//
//        $activeShift->confirmed_steward = 1;
//        $activeShift->save();
//
//        request()->session()->flash('success', 'Επιτυχής επιβεβαίωση');
//        return redirect( route('active-shift.index') );
//    }

    private function checkShiftOverlap($assignedGuardIds, $data)
    {
        $quantum = 20;  // Minutes
        $overLap = 0;

        if ( isset($data['active-shift-id']) )
        {
            $activeShift = ActiveShift::find($data['active-shift-id']);
        }

        foreach ($assignedGuardIds as $guardId)
        {
            if ($guardId == 'absent') continue;

            $guard = Guard::findOrFail($guardId);

            foreach ( $guard->activeShifts()->get() as $guardShift )
            {
                $counter = 0;
                $guardShiftFrom = date('d-m-Y H:i:s', strtotime($guardShift->from));
                $guardShiftUntil = date('d-m-Y H:i:s', strtotime($guardShift->until));
                $guardShiftDurationMinutes = (strtotime($guardShiftUntil) - strtotime($guardShiftFrom))/60;

                if ( isset($activeShift) and ($guardShift->id == $activeShift->id) )
                {
                    continue;
                }

                $staticDate = $data['active-shift-date'];
                $staticShift = Shift::find($data['shift-id']);
                $checkFrom = date('d-m-Y H:i:s', strtotime($staticDate.' '.$staticShift->shift_from));
                $checkUntil = date('d-m-Y H:i:s', strtotime($staticDate.' '.$staticShift->shift_until));
                $durationInMinutes = $this->calculateDurationInMinutes($checkFrom, $checkUntil);  // CHECK IF SHIFT ENDS NEXT DAY

                while ($counter < $guardShiftDurationMinutes)
                {
//                    ---------------------------  DEBUG  -------------------------------
//                    print_r( date('d-m-Y H:i:s', strtotime($checkFrom)).' -> '.date('d-m-Y H:i:s', strtotime($guardShiftFrom.' +'.$counter.' minutes')).' -> '.date('d-m-Y H:i:s', strtotime($checkFrom.' +'.$durationInMinutes.' minutes')) );
//                    echo "<br>";

                    if (    (strtotime($guardShiftFrom.' +'.$counter.' minutes') >= strtotime($checkFrom))
                        and (strtotime($guardShiftFrom.' +'.$counter.' minutes') < strtotime($checkFrom.' +'.$durationInMinutes.' minutes')) )
                    {
                        $overLap = 1;
                    }
                    $counter += $quantum;
                }
            }
        }
        return $overLap;
    }

    private function calculateDurationInMinutes($from, $until)
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

        return $duration;
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
        $weekdayMorningDimes = 0;
        $weekdayEveningDimes = 0;
        $weekdayNightDimes = 0;
        $holidayMorningDimes = 0;
        $holidayEveningDimes = 0;
        $holidayNightDimes = 0;

        $previousFrame = null;
        $frameStart = null;
        $frameEnd = null;
        $frameFactor = null;

        $isHoliday = 0;

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
                    $isHoliday = 1;

                    $factor = DB::table('factors')
                        ->where('name', 'sunday_'.$frame.'_rate')
                        ->value('rate');

                    $dimeName = 'sunday_'.$frame.'_rate';
                }
                else
                {
                    $factor = DB::table('factors')
                        ->where('name', $day.'_'.$frame.'_rate')
                        ->value('rate');

                    $dimeName = $day.'_'.$frame.'_rate';
                }

                switch ($dimeName)
                {
                    case 'saturday_morning_rate':
                    case 'weekdays_morning_rate':
                        $weekdayMorningDimes++;
                        break;
                    case 'saturday_evening_rate':
                    case 'weekdays_evening_rate':
                        $weekdayEveningDimes++;
                        break;
                    case 'saturday_night_rate':
                    case 'weekdays_night_rate':
                        $weekdayNightDimes++;
                        break;
                    case 'sunday_morning_rate':
                        $holidayMorningDimes++;
                        break;
                    case 'sunday_evening_rate':
                        $holidayEveningDimes++;
                        break;
                    case 'sunday_night_rate':
                        $holidayNightDimes++;
                        break;
                }

                $tempFactor = $factor * $tempFrameDuration;     // FOR SECONDS
                $frameFactor += $tempFactor;
            }
        }

        // DEBUG
//        print_r(    'Normal Morning: '.($weekdayMorningDimes / 6).
//                    '<br>Normal Evening: '.($weekdayEveningDimes / 6).
//                    '<br>Normal Night: '.($weekdayNightDimes / 6).
//                    '<br>Holiday Morning: '.($holidayMorningDimes / 6).
//                    '<br>Holiday Evening: '.($holidayEveningDimes / 6).
//                    '<br>Holiday Night: '.($holidayNightDimes / 6) );

        $factorData = [
            'frame_factor'   =>  ($frameFactor / 3600),
            'weekday_morning'    =>  ($weekdayMorningDimes / 6),
            'weekday_evening'   =>  ($weekdayEveningDimes / 6),
            'weekday_night'     =>  ($weekdayNightDimes / 6),
            'holiday_morning'   =>  ($holidayMorningDimes / 6),
            'holiday_evening'   =>  ($holidayEveningDimes / 6),
            'holiday_night'   =>  ($holidayNightDimes / 6),
            'is_holiday'    =>  $isHoliday,
        ];

        return $factorData;
    }

    private function findOrCreateAbsentGuard()
    {
        $absenceCompany = Company::firstOrCreate([
            'name'  =>  'Test Company',
            'active'    =>  0,
        ]);

        $absentGuard = Guard::firstOrCreate([
            'name'  =>  'ΦΥΛΑΚΑΣ',
            'surname'   =>  'ΑΠΩΝ/ΟΥΣΑ',
            'active'    =>  0,
            'company_id'    =>  $absenceCompany->id,
        ]);

        return $absentGuard->id;
    }

    public function exportByLocation(Location $location, Request $request)
    {
        $activeShiftsIds = $request->get('activeShifts');
        $activeShifts = ActiveShift::find($activeShiftsIds);

        if ( is_null($activeShifts) or !isset($activeShifts) )
        {
            request()->session()->flash('warning', 'Δεν υπάρχουν βάρδιες για το σημέιο φύλαξης.');
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
            'year'      =>  'required',
        ]);

        $locationId = $data['location'];
        $allActiveShifts = ActiveShift::all();
        $month = $data['month'];
        $year = $data['year'];

        foreach ($allActiveShifts as $row)
        {
            if ( ($row->shift->location->id == $locationId) )
            {
                if ( (($month != date('m', strtotime($row->from))) and ($month != 'all'))
                    or (($year != date('Y', strtotime($row->from)))  and ($year != 'all')) )
                {
                    continue;
                }

                $activeShifts[] = $row;
            }
        }

        if ($activeShifts == [])
        {
            $request->session()->flash('warning', 'Δεν υπάρχουν επιβεβαιωμένες βάρδιες για αυτό το σημείο φύλαξης για αυτό το χρονικό διάστημα.');
            return redirect(route('active-shift.index'));
        }

        return view('active-shift.show-by-location', compact('activeShifts', 'locationId', 'month', 'year'));
    }

    private function getMonthsYears()
    {
        $months = [];
        $years = [];
        $activeShifts = DB::table('active_shifts')->get();

        foreach ($activeShifts as $activeShift)
        {
            $months[] = date('m', strtotime($activeShift->from));
            $years[] = date('Y', strtotime($activeShift->until));
        }

        if (is_null($months) or !isset($months) or is_null($years) or !isset($years))
            return false;

        $uniqueMonths = array_unique($months);
        $uniqueYears = array_unique($years);

        sort($uniqueMonths);
        sort($uniqueYears);

        for ($i=0; $i<sizeof($uniqueMonths); $i++)
        {
            $uniqueMonths[$i] = [
                'name'  =>  $this->getGreekMonth($uniqueMonths[$i]),
                'value' =>  $uniqueMonths[$i],
            ];
        }

        $monthsYears = [
            'months'    =>  $uniqueMonths,
            'years'     =>  $uniqueYears,
        ];

        return $monthsYears;
    }

    public function exportPdf(Location $location, Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $year = $data['year'];
        $month = $data['month'];

        $allActiveShifts = $location->activeShifts()->get();

        if ( !isset($allActiveShifts) or is_null($allActiveShifts) )
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν βάρδιες για εξαγωγή.');
            return redirect()->back();
        }

        if ($month == 'all')
        {
            $from = date('d/m/Y', strtotime('Jan 1 '.$year));
            $to = date('d/m/Y', strtotime('Dec 31 '.$year));
        }
        else
        {
            // Use mktime() and date() function to
            // convert number to month name
            $month_name = date("F", mktime(0, 0, 0, $month, 10));

            $from = date('01/m/Y', strtotime($month_name.' '.$year));
            $to = date('t/m/Y', strtotime($month_name.' '.$year));
        }

        $guards = Guard::all();

        foreach ($guards as $guard)
        {
            foreach ($guard->activeShifts()->get() as $activeShift)
            {
                if ( ((($month == date('m', strtotime($activeShift->from))) or ($month == 'all') ) and ($year == date('Y', strtotime($activeShift->from))) ) and
                    ( $activeShift->location_id == $location->id ) and
                    ( $activeShift->confirmed_supervisor == 1 ) )
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

    public function exportCommitteePdf(Request $request)
    {
        $data = $request->all();
        $locations = Location::all();
        $month = $data['month'];
        $year = $data['year'];

        if ($month == 'all')
        {
            $from = date('d/m/Y', strtotime('Jan 1 '.$year));
            $to = date('d/m/Y', strtotime('Dec 31 '.$year));
        }
        else
        {
            // Use mktime() and date() function to
            // convert number to month name
            $month_name = date("F", mktime(0, 0, 0, $month, 10));
            $from = date('01/m/Y', strtotime($month_name.' '.$year));
            $to = date('t/m/Y', strtotime($month_name.' '.$year));
        }

        $totalHoursAbsent = 0;
        $totalFactorAbsent = 0;
        $totalTemp = [];

        foreach ($locations as $location)
        {
            $locShifts[$location->name][] = $location->activeShifts()->get();
        }

        foreach ($locShifts as $key => $value)
        {
            $totalHoursAbsentByLocation = 0;

            foreach ($value[0] as $activeShift)
            {
                foreach ($activeShift->guards()->get() as $guard)
                {
                    // Inactive Company contains the Absent Guard Instance.
                    if ( ((date('m', strtotime($activeShift['date'])) == $month) or ($month == 'all')) and ($guard->company->active == 1) )
                    {
                        $locationGuardArray[$key][] = [
                            'guard_id'  =>  $guard->id,
                            'surname'   =>  $guard->surname,
                            'weekday_regular'   =>  ($activeShift->weekday_morning + $activeShift->weekday_evening),
                            'weekday_night'     =>  $activeShift->weekday_night,
                            'holiday_regular'   =>  ($activeShift->holiday_morning + $activeShift->holiday_evening),
                            'holiday_night'     =>  $activeShift->holiday_night
                        ];
                    }
                }

                if ( (date('m', strtotime($activeShift['date'])) == $month) or ($month == 'all') )
                {
                    $activeShifts[$key][] = $activeShift;
                    $totalHoursAbsentByLocation += $activeShift['absent'];
                    $totalHours[$key]['totalHoursAbsentByLocation'] = $totalHoursAbsentByLocation;

                    $totalHoursAbsent += $activeShift['absent'];
                    $totalFactorAbsent += ($activeShift['absent'] * ($activeShift['factor'] / $activeShift['duration']) );
                }
            }
        }

        foreach ($locationGuardArray as $locationName => $value)
        {
            $groups = [];

            $totalTemp[$locationName]['weekday_regular'] = 0;
            $totalTemp[$locationName]['weekday_night'] = 0;
            $totalTemp[$locationName]['holiday_regular'] = 0;
            $totalTemp[$locationName]['holiday_night'] = 0;

            foreach ($value as $item)
            {
                $key = $item['surname'];

                if (!array_key_exists($key, $groups))
                {
                    $groups[$key] = [
                        'weekday_regular'   =>  $item['weekday_regular'],
                        'weekday_night'     =>  $item['weekday_night'],
                        'holiday_regular'   =>  $item['holiday_regular'],
                        'holiday_night'     =>  $item['holiday_night'],
                    ];
                }
                else
                {
                    $groups[$key]['weekday_regular'] += $item['weekday_regular'];
                    $groups[$key]['weekday_night'] += $item['weekday_night'];
                    $groups[$key]['holiday_regular'] += $item['holiday_regular'];
                    $groups[$key]['holiday_night'] += $item['holiday_night'];
                }

                $totalTemp[$locationName]['weekday_regular'] += $item['weekday_regular'];
                $totalTemp[$locationName]['weekday_night'] += $item['weekday_night'];
                $totalTemp[$locationName]['holiday_regular'] += $item['holiday_regular'];
                $totalTemp[$locationName]['holiday_night'] += $item['holiday_night'];
            }

            $exportData[$locationName][] = $groups;
        }

//        return view('active-shift.export-committee-pdf',
//            compact('from', 'to', 'totalHours', 'totalHoursAbsent', 'totalFactorAbsent', 'exportData', 'totalTemp'));

        $pdf = PDF::loadView('/active-shift/export-committee-pdf', compact('from', 'to', 'totalHours', 'totalHoursAbsent', 'totalFactorAbsent', 'exportData', 'totalTemp'));
        return $pdf->download('Σύνολο Βαρδιών.pdf');
    }

    private function getGreekMonth($month)
    {
        switch ($month)
        {
            case '01':
                return 'Ιανουάριος';
                break;
            case '02':
                return 'Φεβρουάριος';
                break;
            case '03':
                return 'Μάρτιος';
                break;
            case '04':
                return 'Απρίλιος';
                break;
            case '05':
                return 'Μάιος';
                break;
            case '06':
                return 'Ιούνιος';
                break;
            case '07':
                return 'Ιούλιος';
                break;
            case '08':
                return 'Αύγουστος';
                break;
            case '09':
                return 'Σεπτέμβριος';
                break;
            case '10':
                return 'Οκτώβριος';
                break;
            case '11':
                return 'Νοέμβριος';
                break;
            case '12':
                return 'Δεκέμβριος';
                break;
        }
    }

    /**
     * AJAX for fetching active shifts
     */
        function fetch(Request $request)
    {
        $data = [];
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
                    ->orWhere('is_holiday', '=', 1)
                    ->get();
                break;
            default:
                $daysOfYear = DB::table('days_of_year')
                    ->where('is_holiday', '!=', 1)
                    ->whereNotIn('day', ['Saturday', 'Sunday'])
                    ->get();
                break;
        }

        foreach ($daysOfYear as $item)
        {
            if ( $value == date('m', strtotime($item->date)) )
            {
                $data[] = $item;
            }
        }

        $activeShiftsDates = DB::table('active_shifts')
            ->where('shift_id', '=', $shiftId)
            ->where('deleted_at', '=', 'NULL')
            ->pluck('date')
            ->toArray();

        $output = '<option value="" disabled>Επιλέξτε Ημέρα</option>';

        foreach ($data as $row)
        {
            if ( (in_array(date('Y-m-d', strtotime($row->date)), $activeShiftsDates)) and ($activeShiftsDates != []) )
            {
                continue;
            }

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

            $output .= '<option value="'.$row->date.'">'.$greekDay.' '.date('d-m-Y', strtotime($row->date)).'</option>';
        }
        echo $output;
    }
}
