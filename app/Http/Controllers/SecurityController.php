<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SecurityController extends Controller
{
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
        $guards = Guard::where('company_id', $company->id)->get();
        return view('security.edit', compact('company', 'guards'));
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
