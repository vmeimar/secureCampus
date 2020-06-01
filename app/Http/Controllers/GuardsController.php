<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $this->getGuardsShifts($guard);

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

    private function getGuardsShifts (Guard $guard)
    {
        $guardingData = DB::table('guarding')
            ->select('guarding_shift_id', 'guarding_shift_date', 'guarding_guards_ids')
            ->get()
            ->toArray();

        foreach ($guardingData as $item)
        {
            if (in_array($guard->id, explode(', ', $item->guarding_guards_ids)))
            {
                $date = explode(' ', $item->guarding_shift_date);

                $shift = (Shift::find($item->guarding_shift_id))
                    ? Shift::find($item->guarding_shift_id)
                    : '';

                if ($shift == '')
                {
                    continue;
                }

                $shiftFactor []= $this->calculateFactor($shift, $date[0]);
            }
        }

        echo "<pre>";
        print_r($shiftFactor);
        exit;
    }

    private function calculateFactor(Shift $shift, $date)
    {
        $start = strtotime($shift->shift_from);

        $end = ($shift->shift_until < $shift->shift_from)
            ? (strtotime($shift->shift_until) + 3600*24)
            : strtotime($shift->shift_until);

        $duration = ($end - $start) / 3600; // shift's duration in hours

        $timestamp = strtotime($date);

        $morning_start = strtotime("06:00");
        $morning_end = strtotime("14:00");

        $afternoon_start = strtotime("14:00");
        $afternoon_end = strtotime("22:00");

        $night_start = strtotime("22:00");
        $night_end = strtotime("06:00") + 3600 * 24; // 06:00 of next day, add 3600*24 seconds

        switch (date('l', $timestamp))
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
            'morning'   =>  ($this->intersection( $start, $end, $morning_start, $morning_end ) / 3600) * $morningFactor,
            'evening'   =>  ($this->intersection( $start, $end, $afternoon_start, $afternoon_end ) / 3600) * $eveningFactor,
            'night'     =>  ($this->intersection( $start, $end, $night_start, $night_end ) / 3600) * $nightFactor,
            'duration'  =>  $duration,
            'start_day' =>  date('l', $timestamp),
        ];

        return $data;
    }

    private function intersection($s1, $e1, $s2, $e2)  // 20  7  6  14
    {


        if ($e1 < $s2)  // 7 < 6
            return 0;
        if ($s1 > $e2)  //  20 > 14
            return 0;
        if ($s1 < $s2)  //  20 < 6
            $s1 = $s2;
        if ($e1 > $e2)  //  7 > 14
            $e1 = $e2;
        return $e1 - $s1;  //  7 - 20
    }
}
