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
        $user_id = Auth::id();

        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        $companies = Company::all();
        return view('security.index', compact('companies', 'user_id'));
    }

    public function edit(Company $company)
    {
        if (Gate::denies('manage-security'))
        {
            \request()->session()->flash('warning', 'unauthorized action');
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

        $user_id = Auth::id();

        return view('security.create', compact('user_id'));
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

        return redirect()->route('company.index');
    }

    public function destroy(Company $company)
    {
        if (Gate::denies('manage-security'))
        {
            return redirect()->route('profile', ['user' => Auth::id()]);
        }

        if ($company->guards()->count())
        {
            $company->guards()->delete();
        }

        if ($company->delete())
        {
            \request()->session()->flash('success', 'Successfully deleted security company');
        }
        else
        {
            \request()->session()->flash('error', 'Error while deleting security company');
        }

        return redirect()->route('company.index');
    }
}
