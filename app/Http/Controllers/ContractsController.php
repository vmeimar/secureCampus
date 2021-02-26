<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use Throwable;

class ContractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->id();
        $contracts = Contract::all();

        if (is_null($contracts)) {
            return redirect(route('contract.create'));
        } else {
            return view('contract.index', compact('contracts', 'user_id'));
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
            $request->session()->flash('warning', __('messages.langErrorCreate'));
        } else {
            $request->session()->flash('success', __('messages.langSuccessCreate'));
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
            $request->session()->flash('success', __('messages.langSuccessSave'));
        } else {
            $request->session()->flash('warning', __('messages.langErrorSave'));
        }
        return redirect(route('contract.index'));
    }

    public function destroy(Contract $contract, Request $request)
    {
        try {
            $contract->delete();
        } catch (Throwable $e) {
            report($e);
            $request->session()->flash('error', __('messages.langErrorDelete'));
            return false;
        }
        $request->session()->flash('success', __('messages.langSuccessDelete'));
        return redirect(route('app.index'));
    }
}
