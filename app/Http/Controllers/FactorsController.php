<?php

namespace App\Http\Controllers;

use App\Factor;
use Illuminate\Http\Request;

class FactorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $factors = Factor::all();
        return view('factor.index', compact('factors'));
    }

    public function edit(Factor $factor)
    {
        return view('factor.edit', compact('factor'));
    }

    public function update(Factor $factor)
    {
        $data = request()->validate([
            'name'  => 'required',
            'rate'  => 'required',
        ]);

        $factor->update(['rate' => $data['rate']])
            ? request()->session()->flash('success', 'Επιτυχής αποθήκευση')
            : request()->session()->flash('error', 'Ανεπιτυχής αποθήκευση');

        return redirect(route('factor.index'));
    }

    public function destroy(Factor $factor)
    {
        dd($factor);
    }
}
