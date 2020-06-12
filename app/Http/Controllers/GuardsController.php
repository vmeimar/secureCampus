<?php

namespace App\Http\Controllers;

use App\ActiveShift;
use App\Company;
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
        $guards = Guard::where('company_id', $company->id)->get();
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
        $activeShifts = [];

        $data = request()->validate([
            'date-from' => 'required',
            'date-to' => 'required',
        ]);

        $from = $this->formatDate($data['date-from']);
        $to = $this->formatDate($data['date-to']);

        foreach ( ActiveShift::all() as $item )
        {
            if ( ($this->formatDate($item->date) >= $from) && ($this->formatDate($item->date) <= $to) )
            {
                $activeShifts[] = $item;
            }
        }
        return view('guard.custom-range', compact('activeShifts', 'guard'));
    }

    private function formatDate($d)
    {
        return date('d m y', strtotime($d));
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
            'Name'  =>  $guard->name,
            'Surname' => $guard->surname,
            'Hours' => $totalHours,
            'Credits' => $totalCredits,
        ];

        return Excel::download(new GuardsExport(collect($exportData)), $guard->surname.'_'.$guard->name.'.xlsx');
    }

    public function import(Request $request)
    {
        if (Excel::import(new GuardsImport(), $request->file('import_file')))
        {
            $request->session()->flash('success', 'Επιτυχής εισαγωγή');
        }
        else
        {
            $request->session()->flash('error', 'Αποτυχία κατά την εισαγωγή');
        }

        return redirect()->back();
    }

    /*
     *  CSV EXPORT - WORKING
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
    /*
     *  END OF CSV EXPORT
     */
}
