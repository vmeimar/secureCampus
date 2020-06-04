<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Company;
use App\Guard;
use App\Shift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GuardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Guard $guard)
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        return view('guard.show', compact('guard'));
    }

    public function create(Company $company)
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        return view('guard.create', compact('company'));
    }

    public function store()
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $data = \request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'company' => 'required',
        ]);

        $guard = new Guard();
        $company_id = Company::where('name', $data['company'])->value('id');


        if ($guard->create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'company_id' => $company_id,

        ]))
        {
            \request()->session()->flash('success', 'New Guard created successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while creating new Guard');
        }

        return redirect()->route('company.edit', ['company' => $company_id]);
    }

    public function destroy(Guard $guard)
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

//        $guard->activeShifts()->detach();

        if ($guard->delete())
        {
            \request()->session()->flash('success', 'Guard deleted successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while deleting guard');
        }

        return redirect()->route('company.index');
    }

//    private function calculateFactor(Shift $shift, $date)
//    {
//        $start = strtotime($shift->shift_from);
//
//        $end = ( $shift->shift_until < $shift->shift_from )
//            ? ( strtotime($shift->shift_until) + 3600 * 24 )
//            : strtotime($shift->shift_until);
//
//        $duration = ($end - $start) / 3600; // shift's duration in hours
//        $timestamp = strtotime($date);
//
//        $morning_start = strtotime("06:00");
//        $morning_end = strtotime("14:00");
//        $afternoon_start = strtotime("14:00");
//        $afternoon_end = strtotime("22:00");
//        $night_start = strtotime("22:00");
//        $night_end = strtotime("06:00") + 3600 * 24; // 06:00 of next day, add 3600*24 seconds
//
//        switch ( date('l', $timestamp) )
//        {
//            case 'Saturday':
//                $morningFactor = 1;
//                $eveningFactor = 1.25;
//                $nightFactor = 1.75;
//                break;
//
//            case 'Sunday':
//                $morningFactor = 1.25;
//                $eveningFactor = 1.25;
//                $nightFactor = 2;
//                break;
//
//            default:
//                $morningFactor = 1;
//                $eveningFactor = 1;
//                $nightFactor = 1.75;
//                break;
//        }
//
//        $data = [
//            'start'     =>  $shift->shift_from,
//            'end'       =>  $shift->shift_until,
//            'morning'   =>  ($this->intersection( $start, $end, $morning_start, $morning_end, 'm' ) / 3600) * $morningFactor,
//            'evening'   =>  ($this->intersection( $start, $end, $afternoon_start, $afternoon_end, 'e' ) / 3600) * $eveningFactor,
//            'night'     =>  ($this->intersection( $start, $end, $night_start, $night_end, 'n' ) / 3600) * $nightFactor,
//            'duration'  =>  $duration,
//            'start_day' =>  $date,
//        ];
//
//        return $data;
//    }

    private function calculateFactor(ActiveShift $activeShift)
    {
        $start = strtotime($activeShift->from);
        $end = ( $activeShift->until < $activeShift->from )
            ? ( strtotime($activeShift->until) + 3600 * 24 )
            : strtotime($activeShift->until);

        $duration = ($end - $start) / 3600; // shift's duration in hours

        $morning_start = strtotime("06:00");
        $morning_end = strtotime("14:00");
        $afternoon_start = strtotime("14:00");
        $afternoon_end = strtotime("22:00");
        $night_start = strtotime("22:00");
        $night_end = strtotime("06:00") + 3600 * 24; // 06:00 of next day, add 3600*24 seconds

        switch ( date('l', strtotime($activeShift->date)) )
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
            'start'     =>  $activeShift->from,
            'end'       =>  $activeShift->until,
            'morning'   =>  ($this->intersection( $start, $end, $morning_start, $morning_end, 'm' ) / 3600) * $morningFactor,
            'evening'   =>  ($this->intersection( $start, $end, $afternoon_start, $afternoon_end, 'e' ) / 3600) * $eveningFactor,
            'night'     =>  ($this->intersection( $start, $end, $night_start, $night_end, 'n' ) / 3600) * $nightFactor,
            'duration'  =>  $duration,
            'start_day' =>  date('l', strtotime($activeShift->date)),
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

        if (   ($e1 > $s2)       // morning shift, ends next day, only morning hours. to be further tested
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

    public function exportCsv (Guard $guard)
    {
        $requestData = \request()->validate([
            'month' =>  'required'
        ]);

        if ($requestData['month'] == '')
        {
            \request()->session()->flash('warning', 'select month');
            return redirect()->back();
        }

        $guardShifts = $guard->activeShifts()->get();
        $totalHours = 0;
        $totalCredits = 0;

        foreach ($guardShifts as $activeShift)
        {
            if ( $requestData['month'] != 'all' && $requestData['month'] != date('m', strtotime($activeShift->date)) )
            {
                continue;
            }

            $data = $this->calculateFactor($activeShift);

            $totalHours += $data['duration'];
            $totalCredits += ($data['morning'] + $data['evening'] + $data['night']);
        }

        $exportData = [
            'Name'  =>  $guard->name,
            'Surname' => $guard->surname,
            'Duration' => $totalHours,
            'Total Credits' => $totalCredits,
        ];

        $headers = [
            'Name', 'Surname', 'Duration', 'Credits'
        ];

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv($output, $headers, ';');
        fputcsv($output, $exportData, ';');

        fclose($output);
        return ob_get_clean();
    }
}
