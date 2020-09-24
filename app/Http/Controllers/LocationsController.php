<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Throwable;

class LocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('location.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  =>  'required',
        ]);

        try {
            $location = Location::create([
                'name'  =>  $data['name'],
            ]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        $request->session()->flash('success', 'Επιτυχής δημιουργία');
        return redirect(route('shift.index'));
    }
}
