<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guard;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();
        $companies = Company::where('active', 1)->get();

        return view('security.index', compact('companies', 'user_id'));
    }

    public function edit(Company $company)
    {
        return view('security.edit', compact('company'));
    }

    public function create()
    {
        $user_id = Auth::id();
        return view('security.create', compact('user_id'));
    }

    public function store()
    {
        $data = \request()->validate([
            'name' => 'required',
        ]);

        $company = new Company();

        if ($company->create(['name'  =>  $data['name']]))
        {
            \request()->session()->flash('success', 'Επιτυχής δημιουργία');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά τη δημιουργία');
        }

        return redirect()->route('company.index');
    }

    public function update(Company $company)
    {
        $data = \request()->validate([
            'name' => 'required',
        ]);

        $company->name = $data['name'];

        if ($company->save())
        {
            \request()->session()->flash('success', 'Επιτυχής αποθήκευση');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά την αποθήκευση');
        }

        return redirect()->route('company.index');
    }

    public function destroy(Company $company)
    {
        if ($company->guards()->count())
        {
            $company->guards()->delete();
        }

        if ($company->delete())
        {
            \request()->session()->flash('success', 'Επιτυχής διαγραφή');
        }
        else
        {
            \request()->session()->flash('error', 'Σφάλμα κατά τη διαγραφή');
        }

        return redirect()->route('company.index');
    }

    public function chooseCompany()
    {
        $companies = Company::where('active', 1)->get();

        if (is_null($companies) or !isset($companies))
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν εταιρίες φύλαξης για προβολή.');
            return redirect()->back();
        }

        return view('security.choose-company', compact('companies'));
    }

    public function chooseExport(Request $request)
    {
        $companyId = $request->get('company');
        $company = Company::findOrFail($companyId);
        $monthsYears = $this->getMonthsYears();

        if (!$monthsYears)
        {
            request()->session()->flash('warning', 'Δεν υπάρχουν πραγματοποιημένες βάρδιες για εξαγωγή.');
            return redirect('/profile/'.Auth::id());
        }

        return view('security.choose-export', compact('company', 'monthsYears'));
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

            if ( ! isset($guardShifts) or is_null($guardShifts) )
            {
                \request()->session()->flash('warning', 'Δεν υπάρχουν αποθηκευμένες βάρδιες για έλεγχο.');
                return redirect()->back();
            }

            foreach ($guardShifts as $guardShift)
            {
                if ( ($guardShift['from'] == $prevUntil) and ( ($guardShift['duration'] + $prevDuration) >= 11 ) )
                {
                    $overTimeShifts[$guard->surname.' '.$guard->name][] = $prevShift;
                    $overTimeShifts[$guard->surname.' '.$guard->name][] = $guardShift;
                }

                $prevUntil = $guardShift['until'];
                $prevShift = $guardShift;
                $prevDuration = $guardShift['duration'];
            }
        }

        if ( ! isset($overTimeShifts) or is_null($overTimeShifts) )
        {
            \request()->session()->flash('warning', 'Δεν υπάρχουν φύλακες με υπερεργασία.');
            return redirect()->route('security.choose-company');
        }

        foreach ($overTimeShifts as $key => $value)
        {
            $unique = array_unique($value);
            $collection = collect($unique);
            $sorted = $collection->sortBy('from');
            $data[$key] = $sorted;
        }


        if (isset($sorted) and !is_null($sorted))
        {
//            return view('guard.show-overtime', compact('data'));
            $pdf = PDF::loadView('/security/export-overtime', compact('data'));
            return $pdf->download('Υπερεργασία_Φυλάκων.pdf');
        }
        else
        {
            \request()->session()->flash('warning', 'Δεν υπάρχει φύλακας με υπερεργασία.');
            return redirect()->route('security.choose-company');
        }
    }

    private function getMonthsYears()
    {
        $activeShifts = DB::table('active_shifts')->get();

        if (is_null($activeShifts) or !isset($activeShifts) or (sizeof($activeShifts) == 0))
        {
            return false;
        }

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
}
