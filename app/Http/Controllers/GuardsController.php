<?php

namespace App\Http\Controllers;

use App\Company;
use App\Exports\AllGuardsExport;
use App\Exports\GuardsExport;
use App\Guard;
use App\Imports\GuardsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        return view('guard.show', compact('guard'));
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
            \request()->session()->flash('success', 'Επιτυχής δημιουργία');
        }
        else
        {
            \request()->session()->flash('error', 'Αποτυχία δημιουργίας');
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
        ])  ? request()->session()->flash('success', 'Επιτυχής αποθήκευση')
            : request()->session()->flash('error', 'Σφάλμα κατά την αποθήκευση');

        return redirect()->route('guard.index', $company_id);
    }

    public function destroy(Guard $guard)
    {
        if ($guard->delete())
        {
            \request()->session()->flash('success', 'Επιτυχής διαγραφή φύλακα');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά τη διαγραφή');
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

//        exit;
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
            \request()->session()->flash('warning', 'Δεν υπάρχει φύλακας με υπερεργασία');
            return redirect()->back();
        }
    }

    private function decimal_to_time($decimal)
    {
        $hours = floor($decimal / 60);
        $minutes = floor($decimal % 60);
        $seconds = $decimal - (int)$decimal;
        $seconds = round($seconds * 60);

        return str_pad($hours, 2, "0", STR_PAD_LEFT) . " Ώρες, " . str_pad($minutes, 2, "0", STR_PAD_LEFT) . " Λεπτά ";
    }

    public function export(Guard $guard)
    {
        $requestData = \request()->validate([
            'month' =>  'required'
        ]);

        if ($requestData['month'] == '')
        {
            \request()->session()->flash('warning', 'Επιλέξτε Μήνα');
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

            $totalHours += $activeShift->duration;
            $totalCredits += $activeShift->factor;
        }

        $exportData[] = [
            'Όνομα'  =>  $guard->name,
            'Επώνυμο' => $guard->surname,
            'Ώρες Εργασίας' => $totalHours,
            'Ισοδύναμες Ώρες' => $totalCredits,
        ];

        return Excel::download(new GuardsExport(collect($exportData)), $guard->surname.'_'.$guard->name.'.xlsx');
    }

    public function exportAllGuards(Company $company)
    {
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

            foreach ($guardShifts as $activeShift)
            {
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
