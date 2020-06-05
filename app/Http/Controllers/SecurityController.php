<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guard;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();

        $companies = Company::all();
        return view('security.index', compact('companies', 'user_id'));
    }

    public function edit(Company $company)
    {
        return view('security.edit', compact('company'));
    }

    public function create()
    {
        $user_id = Auth::id();
        return view('security.create', compact('user_id'));
    }

    public function store()
    {
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

    public function update(Company $company)
    {
        $data = \request()->validate([
            'name' => 'required',
        ]);

        $company->name = $data['name'];

        if ($company->save())
        {
            \request()->session()->flash('success', 'Updated successfully');
        }
        else
        {
            \request()->session()->flash('error', 'Error while updating');
        }

        return redirect()->route('company.index');
    }

    public function destroy(Company $company)
    {
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
