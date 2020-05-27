<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guard;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GuardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Shift $shift)
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $guards = Guard::where('active', 1)->orderBy('name', 'asc')->get();

        return view('guard.show', compact('guards', 'shift'));
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
}
