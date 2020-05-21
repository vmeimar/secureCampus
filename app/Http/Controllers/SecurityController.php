<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();
        return view('security.index', compact('companies'));
    }

    public function show(Company $company)
    {
        return view('security.show', compact('company'));
    }

    public function edit(Company $company)
    {
        if (Gate::denies('manage-security'))
        {
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $guards = Guard::where('company_id', $company->id)->get();
        return view('security.edit', compact('company', 'guards'));
    }

    public function create()
    {
        if (Gate::denies('manage-security'))
        {
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        return view('security.create');
    }

    public function store()
    {
        if (Gate::denies('manage-security'))
        {
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $data = \request()->validate([
            'name' => 'required',
        ]);

        $company = new Company();

        if ($company->create(['name'  =>  $data['name']]))
        {
            \request()->session()->flash('success', 'New Company created successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while creating new Company');
        }

        return redirect()->route('profile', ['user' => Auth::id()]);
    }

    public function destroy(Company $company)
    {
        if (Gate::denies('manage-security'))
        {
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $company->delete();

        return redirect()->route('company.index');

    }
}
