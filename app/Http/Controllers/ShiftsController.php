<?php

namespace App\Http\Controllers;

use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $guards = DB::table('guards')
            ->where('active', '=', '1')
            ->get();

//        $locations = DB::table('locations')
//            ->get();


        return view('shift.create', compact('guards'));
    }

    public function store()
    {
//        $this->validate(\request(), [
//            'guard_name'    =>  'required'
//        ]);



        $data = \request()->validate([
            'guard_name' => 'required',
//            'shift_from' => 'required',
//            'shift_until' => 'required',
//            'shift_location' => 'required',
        ]);


        dd(\request()->all());


//        auth()->user()->shifts()->create($data);
    }
}
