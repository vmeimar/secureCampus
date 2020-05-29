<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Shift;
use App\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Throwable;

class GuardingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $authUser = User::find(Auth::id());

        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', $authUser->id);
        }

        $activeShiftsIds = $this->getActiveShiftsIds();

        if (Gate::allows('manage-anything'))
        {
            $shifts = Shift::whereIn('id', $activeShiftsIds)->get();
        }
        else
        {
            $allActiveShifts = Shift::whereIn('id', $activeShiftsIds)->get();
            $wantedIds = [];

            foreach ($allActiveShifts as $item)
            {
                if ($authUser->department_id == $item->location->department_id)
                {
                    $wantedIds[] = $item->id;
                }
            }

            $shifts = Shift::whereIn('id', $wantedIds)->get();
        }

        $viewShiftsData = [];

        foreach ($shifts as $shift)
        {
            $confirmation = DB::table('guarding')
                            ->where('guarding_shift_id', $shift->id)
                            ->value('confirmed');

            $viewShiftsData[] = [
                'shift_id'  =>  $shift->id,
                'shift_name'    =>  $shift->name,
                'shift_from'  =>  $shift->shift_from,
                'shift_until'  =>  $shift->shift_until,
                'shift_guards'  =>  implode(', ', $shift->guards()->get()->pluck('surname')->toArray()),
                'shift_confirmed'   =>  ($confirmation == 0 ? 'No' : 'Yes'),
            ];
        }

        return view('guarding.index', compact('viewShiftsData'));
    }

    public function store(Shift $shift)
    {
        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', Auth::id());
        }

        $shift_guards = $shift->guarded()->get();

        $data = \request()->validate([
            'date'  =>  'required',
        ]);

        $date  = new \DateTime( $data['date'] );

        if ( isset($shift_guards) && ($shift_guards->count() > 0) )
        {
            foreach ($shift_guards as $shift_guard)
            {
                $shift->guarded()->detach($shift_guard);
            }
        }

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

        $assignedShiftData = DB::table('guard_shift')
            ->whereIn('guard_id', $guardIds)
            ->where('shift_id', $shift->id)
            ->get();

        $this->populateGuardingTable($assignedShiftData, $date);

        return redirect(route('guarding.index'));
    }

    public function update(Shift $shift)
    {
        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', Auth::id());
        }

        try {
            DB::table('guarding')
                ->where('guarding_shift_id', $shift->id)
                ->update([
                    'confirmed'   =>  1
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
        }
        return redirect(route('guarding.index'));
    }

    public function destroy(Shift $shift)
    {
        if (Gate::denies('manage-shifts'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', Auth::id());
        }

        $shift_guards = $shift->guarded()->get();

        if ( isset($shift_guards) && $shift_guards->count() > 0)
        {
            foreach ($shift_guards as $shift_guard)
            {
                $shift->guarded()->detach($shift_guard);
            }
        }

        try {
            DB::table('guarding')
                ->where('guarding_shift_id', $shift->id)
                ->update([
                    'confirmed'   =>  0
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
        }

        return redirect( route('guarding.index') );
    }

    private function populateGuardingTable ($assignedShiftData, $date)
    {
        $this->createIfNotExistsGuardingTable();

        foreach ($assignedShiftData as $shiftDatum)
        {
            $guards_ids[] = $shiftDatum->guard_id;
            $shift_id   =   $shiftDatum->shift_id;
        }

        try {
            DB::table('guarding')->insert([
                'guarding_guards_ids' =>  implode(', ', $guards_ids),
                'guarding_shift_id' =>  $shift_id,
                'guarding_shift_date'   =>  $date,
                'confirmed' =>  0,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
        }
    }

    private function createIfNotExistsGuardingTable ()
    {
        if (! Schema::hasTable('guarding'))
        {
            try {
                Schema::create('guarding', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('guarding_shift_id');
                    $table->string('guarding_guards_ids');
                    $table->string('guarding_shift_date');
                    $table->tinyInteger('confirmed');
                    $table->timestamps();
                });
            } catch (\Illuminate\Database\QueryException $e) {
                dd($e);
            }
            return true;
        }
        return false;
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
