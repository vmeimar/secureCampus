<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Throwable;

class GuardingController extends Controller
{
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
}
