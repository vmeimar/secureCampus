<?php

namespace App\Http\Controllers;

use App\Department;
use App\Guard;
use App\Shift;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Throwable;

class GuardingController extends Controller
{
    public function index()
    {
        $authUser = User::find(Auth::id());
        $activeShiftsIds = $this->getActiveShiftsIds();

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        if (Gate::allows('manage-anything'))
        {
            $shifts = Shift::whereIn('id', $activeShiftsIds)->get();
        }
        else
        {
            $allActiveShifts = Shift::whereIn('id', $activeShiftsIds)->get();

            foreach ($allActiveShifts as $item)
            {
                if ($authUser->department_id == $item->location->department_id)
                {
                    $wantedIds[] = $item->id;
                }
            }

            $shifts = Shift::whereIn('id', $wantedIds)->get();
        }

        return view('guarding.index', compact('shifts'));
    }

    public function store(Shift $shift)
    {
        $guardIds = $this->fetchData($shift->number_of_guards);

        foreach ($guardIds as $guardId)
        {
            $guard = Guard::find($guardId);

            try {
                $shift->guarded()->attach($guard);
            } catch (Throwable $e) {
                report($e);

                return false;
            }
        }

        return redirect(route('shift.index'));
    }


    private function fetchData ($numberOfGuards)
    {
        switch ($numberOfGuards)
        {
            case 1:
                $data = \request()->validate([
                    'guard1'    =>  'required'
                ]);
                break;
            case 2:
                $data = \request()->validate([
                    'guard1'    =>  'required',
                    'guard2'    =>  'required',
                ]);
                break;
            case 3:
                $data = \request()->validate([
                    'guard1'    =>  'required',
                    'guard2'    =>  'required',
                    'guard3'    =>  'required',
                ]);
                break;
            case 4:
                $data = \request()->validate([
                    'guard1'    =>  'required',
                    'guard2'    =>  'required',
                    'guard3'    =>  'required',
                    'guard4'    =>  'required',
                ]);
                break;
        }

        return $data;
    }

    private function getActiveShiftsIds()
    {
        $activeShiftsRecords = DB::table('guard_shift')
            ->select('shift_id')
            ->groupBy('shift_id')
            ->pluck('shift_id');

        return $activeShiftsRecords;
    }
}
