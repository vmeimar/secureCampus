<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contract = Contract::first();

        if (is_null($contract) or !isset($contract->id)) {
            return redirect(route('contract.create'));
        } else {
            return view('contract.index', compact('contract'));
        }
    }

    public function create()
    {
        return view('contract.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dean_act'   =>  'required',
            'ada'   =>  'required',
            'adam'  =>  'required',
            'contract_start_date'  =>  'required',
        ]);

        $contract = Contract::create([
            'dean_act'  =>  $data['dean_act'],
            'ada'   =>  $data['ada'],
            'adam'  =>  $data['adam'],
            'contract_start_date'   =>  $data['contract_start_date']
        ]);

        if (!$contract->id) {
            $request->session()->flash('warning', 'Σφάλμα κατά τη δημιουργία.');
        } else {
            $request->session()->flash('success', 'Επιτυχής δημιουργία.');
        }

        return redirect(route('contract.index'));
    }

    public function edit(Contract $contract)
    {
        return view('contract.edit', compact('contract'));
    }

    public function update(Contract $contract, Request $request)
    {
        $data = $request->validate([
            'dean_act'  =>  'required',
            'ada'  =>  'required',
            'adam'  =>  'required',
            'contract_start_date'  =>  'required',
        ]);

        if ($contract->update([
            'dean_act'  =>  $data['dean_act'],
            'ada'  =>  $data['ada'],
            'adam'  =>  $data['adam'],
            'contract_start_date'  =>  $data['contract_start_date'],
        ])) {
            $request->session()->flash('success', 'Επιτυχής αποθήκευση.');
        } else {
            $request->session()->flash('warning', 'Σφάλμα κατά την αποθήκευση.');
        }
        return redirect(route('contract.index'));
    }
}
