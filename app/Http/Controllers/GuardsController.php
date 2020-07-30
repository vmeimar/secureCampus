<?php

namespace App\Http\Controllers;

use App\Company;
use App\Exports\AllGuardsExport;
use App\Exports\GuardsExport;
use App\Guard;
use App\Imports\GuardsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class GuardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Company $company)
    {
        $guards = Guard::where('company_id', $company->id)->paginate(15);
        return view('guard.index', compact('company', 'guards'));
    }

    public function show(Guard $guard)
    {
        $activeShifts = $guard->activeShifts()->get()->toArray();

        foreach ($activeShifts as $activeShift)
        {
            $months[] = date('m', strtotime($activeShift['from']));
            $years[] = date('Y', strtotime($activeShift['until']));
        }

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

        return view('guard.show', compact('guard', 'uniqueMonths', 'uniqueYears'));
    }

    public function create(Company $company)
    {
        return view('guard.create', compact('company'));
    }

    public function store()
    {
        $data = \request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'company' => 'required',
        ]);

        $guard = new Guard();
        $company_id = Company::where('name', $data['company'])->value('id');


        if ( $guard->create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'company_id' => $company_id,

        ]) )
        {
            \request()->session()->flash('success', 'Επιτυχής δημιουργία.');
        }
        else
        {
            \request()->session()->flash('error', 'Αποτυχία δημιουργίας.');
        }

        return redirect()->route('guard.index', $company_id);
    }

    public function edit(Guard $guard)
    {
        return view('guard.edit', compact('guard'));
    }

    public function update(Guard $guard)
    {
        $data = request()->validate([
            'name'  =>  'required',
            'surname'  =>  'required',
            'company'  =>  'required',
        ]);

        $company_id = Company::where('name', $data['company'])->value('id');

        $guard->update([
            'name'  =>  $data['name'],
            'surname'  =>  $data['surname'],
            'company_id'  =>  $company_id,
        ])  ? request()->session()->flash('success', 'Επιτυχής αποθήκευση.')
            : request()->session()->flash('error', 'Σφάλμα κατά την αποθήκευση.');

        return redirect()->route('guard.index', $company_id);
    }

    public function destroy(Guard $guard)
    {
        if ($guard->delete())
        {
            \request()->session()->flash('success', 'Επιτυχής διαγραφή φύλακα.');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά τη διαγραφή.');
        }

        return redirect()->route('guard.index', $guard->company()->value('id'));
    }

    public function showCustomRangeShifts(Guard $guard)
    {
        $duration = 0;
        $totalCredits = 0;
        $activeShifts = [];

        $data = request()->validate([
            'date-from' => 'required',
            'date-to' => 'required',
        ]);

        $from = strtotime($data['date-from']);
        $to = strtotime($data['date-to'].' +24 hours');

        foreach ( $guard->activeShifts()->get() as $item )
        {
            if ( ($from <= strtotime($item->date)) and ($to >= strtotime($item->date)) )
            {
                $activeShifts[] = $item;
                $duration += $item->duration;
                $totalCredits += $item->factor;
            }
        }
        $totalDuration = $this->decimal_to_time($duration * 60);

        return view('guard.custom-range', compact('activeShifts', 'guard', 'totalCredits', 'totalDuration'));
    }

    public function showOvertime()
    {
        $guards = Guard::all();

        foreach ($guards as $guard)
        {
            $guardShifts = $guard->activeShifts()->get()->sortBy('from');
            $prevUntil = null;
            $prevShift= null;
            $prevDuration = 0;

            foreach ($guardShifts as $guardShift)
            {
                if ( ($guardShift['from'] == $prevUntil) and ( ($guardShift['duration'] + $prevDuration) >= 11 ) )
                {
                    $overTimeShiftsPair[] = [$prevShift, $guardShift];
                }

                $prevUntil = $guardShift['until'];
                $prevShift = $guardShift;
                $prevDuration = $guardShift['duration'];
            }
        }

        if (isset($overTimeShiftsPair) and !is_null($overTimeShiftsPair))
        {
            return view('guard.show-overtime', compact('overTimeShiftsPair'));
        }
        else
        {
            \request()->session()->flash('warning', 'Δεν υπάρχει φύλακας με υπερεργασία.');
            return redirect()->back();
        }
    }

    private function decimal_to_time($decimal)
    {
        $hours = floor($decimal / 60);
        $minutes = floor($decimal % 60);

        return str_pad($hours, 2, "0", STR_PAD_LEFT) . " Ώρες, " . str_pad($minutes, 2, "0", STR_PAD_LEFT) . " Λεπτά ";
    }

    public function export(Guard $guard)
    {
        $requestData = \request()->validate([
            'month' =>  'required',
            'year'  =>  'required',
        ]);

        if ($requestData['month'] == '' or $requestData['year'] == '')
        {
            \request()->session()->flash('warning', 'Επιλέξτε μήνα και έτος για εξαγωγή');
            return redirect()->back();
        }

        $guardShifts = $guard->activeShifts()->get();
        $totalHours = 0;
        $totalCredits = 0;

        foreach ($guardShifts as $activeShift)
        {
            if ( (($requestData['month'] != 'all') and ($requestData['month'] != date('m', strtotime($activeShift->date))))
            or (($requestData['year'] != 'all') and ($requestData['year'] != date('Y', strtotime($activeShift->date)))) )
            {
                continue;
            }

            $totalHours += $activeShift->duration;
            $totalCredits += $activeShift->factor;
        }

        $exportData[] = [
            'Όνομα'  =>  $guard->name,
            'Επώνυμο' => $guard->surname,
            'Ώρες Εργασίας' => $totalHours,
            'Ισοδύναμες Ώρες' => $totalCredits,
            'Μήνας' =>  $requestData['month'] == 'all' ? 'Όλοι οι μήνες' : $requestData['month'],
            'Έτος'  =>  $requestData['year'] == 'all' ? 'Όλα τα έτη' : $requestData['year'],
        ];

        return Excel::download(new GuardsExport(collect($exportData)), $guard->surname.'_'.$guard->name.'.xlsx');
    }

    public function exportAllGuards(Company $company)
    {
        $data = \request()->validate([
            'month' =>  'required',
        ]);

        $guards = $company->guards()->get();

        if (!isset($guards) or is_null($guards))
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν φύλακες για εξαγωγή.');
            return redirect()->back();
        }

        foreach ($guards as $guard)
        {
            $guardShifts = $guard->activeShifts()->get();
            $totalHours = 0;
            $totalCredits = 0;

            foreach ($guardShifts as $activeShift)
            {
                if ( ($data['month'] != 'all') and (date('m', strtotime($activeShift->date)) != $data['month']) )
                {
                    continue;
                }

                $totalHours += $activeShift->duration;
                $totalCredits += $activeShift->factor;
            }

            $exportData[] = [
                'id'    =>  $guard->id,
                'name'  =>  $guard->name,
                'surname'   =>  $guard->surname,
                'total_hours'   =>  $totalHours,
                'total_credits' =>  $totalCredits
            ];
        }

        return Excel::download(new AllGuardsExport(collect($exportData)), $company->name.'.xlsx');
    }

    public function exportAllGuardsPdf(Company $company)
    {
        $data = \request()->validate([
            'month' =>  'required',
            'year'  =>  'required',
        ]);

        $guards = $company->guards()->get();

        if (!isset($guards) or is_null($guards))
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν φύλακες για εξαγωγή');
            return redirect()->back();
        }

        foreach ($guards as $guard)
        {
            $guardShifts = $guard->activeShifts()->get();
            $totalHours = 0;
            $totalCredits = 0;

            $weekday_morning = 0;
            $weekday_evening = 0;
            $weekday_night = 0;
            $holiday_morning = 0;
            $holiday_evening = 0;
            $holiday_night = 0;

            foreach ($guardShifts as $activeShift)
            {
                if ( (($data['month'] != 'all') and (date('m', strtotime($activeShift->date)) != $data['month']))
                    or ( date('Y', strtotime($activeShift->date)) != $data['year'] ) )
                {
                    continue;
                }

                $totalHours += $activeShift->duration;
                $weekday_morning += $activeShift->weekday_morning;
                $weekday_evening += $activeShift->weekday_evening;
                $weekday_night += $activeShift->weekday_night;
                $holiday_morning += $activeShift->holiday_morning;
                $holiday_evening += $activeShift->holiday_evening;
                $holiday_night += $activeShift->holiday_night;
                $totalCredits += $activeShift->factor;
            }

            $exportData[] = [
                'id'    =>  $guard->id,
                'name'  =>  $guard->name,
                'surname'   =>  $guard->surname,
                'weekday_morning'   =>  $weekday_morning,
                'weekday_evening'   =>  $weekday_evening,
                'weekday_night'   =>  $weekday_night,
                'holiday_morning'   =>  $holiday_morning,
                'holiday_evening'   =>  $holiday_evening,
                'holiday_night'   =>  $holiday_night,
                'total_hours'   =>  $totalHours,
                'total_credits' =>  $totalCredits
            ];
        }

        $pdf = PDF::loadView('/guard/export-all-guards-pdf', compact('exportData'))->setPaper('A4');
        return $pdf->download($company->name.'.pdf');
//        return view('guard.export-all-guards-pdf', compact('exportData'));
    }

    public function exportCommittee(Request $request)
    {

        $data = $request->validate([
            'month' =>  'required',
            'year' =>  'required',
        ]);

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


        $pdf = PDF::loadView('/guard/export-committee', compact('from', 'to'))->setPaper('a4');
        return $pdf->download('Βεβαίωση_Επιτροπής.pdf');
    }

    public function import(Request $request)
    {
        try {
            (new GuardsImport)->import($request->file('import_file'));
        } catch (\Exception $e) {
            $failures = $e->failures();
            dd($failures[0]);
        }

        return redirect()->back();
    }

    public function exportByMonth(Company $company)
    {
        $monthsYears = $this->getMonthsYears();
        return view('guard.export-by-month', compact('company', 'monthsYears'));
    }

    private function getMonthsYears()
    {
        $activeShifts = DB::table('active_shifts')->get();

        foreach ($activeShifts as $activeShift)
        {
            $months[] = date('m', strtotime($activeShift->from));
            $years[] = date('Y', strtotime($activeShift->until));
        }

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
     * CSV EXPORT - WORKING
     */
//    public function exportCsv (Guard $guard)
//    {
//        $requestData = \request()->validate([
//            'month' =>  'required'
//        ]);
//
//        if ($requestData['month'] == '')
//        {
//            \request()->session()->flash('warning', 'select month');
//            return redirect()->back();
//        }
//
//        $guardShifts = $guard->activeShifts()->get();
//        $totalHours = 0;
//        $totalCredits = 0;
//
//        foreach ($guardShifts as $activeShift)
//        {
//            if ( $requestData['month'] != 'all' && $requestData['month'] != date('m', strtotime($activeShift->date)) )
//            {
//                continue;
//            }
//
//            $data = $this->calculateFactor($activeShift);
//
//            $totalHours += $data['duration'];
//            $totalCredits += ($data['morning'] + $data['evening'] + $data['night']);
//        }
//
//        $exportData = [
//            'Name'  =>  $guard->name,
//            'Surname' => $guard->surname,
//            'Duration' => $totalHours,
//            'Total Credits' => $totalCredits,
//        ];
//
//        $headers = [
//            'Name', 'Surname', 'Duration', 'Credits'
//        ];
//
//        // output headers so that the file is downloaded rather than displayed
//        header('Content-Type: text/csv; charset=utf-8');
//        header('Content-Disposition: attachment; filename=data.csv');
//
//        // create a file pointer connected to the output stream
//        $output = fopen('php://output', 'w');
//
//        // output the column headings
//        fputcsv($output, $headers, ';');
//        fputcsv($output, $exportData, ';');
//
//        fclose($output);
//        return ob_get_clean();
//    }
}
