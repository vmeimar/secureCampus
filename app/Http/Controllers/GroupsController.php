<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Throwable;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->id();
        $groups = Group::all();

        if (count($groups) == 0) {
            \request()->session()->flash('warning', __('messages.langNoRecordsExist'));
            return redirect(route('group.create'));
        }

        return view('group.index', compact('user_id', 'groups'));
    }

    public function create()
    {
        return view('group.create');
    }

    public function edit(Group $group)
    {
        return view('group.edit', compact('group'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  =>  'required',
        ]);

        try {
            $group = Group::create([
                'name'  => $data['name'],
                'ada'  => $data['ada'],
                'dean_act'  => $data['dean_act'],
            ]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        $request->session()->flash('success', __('messages.langSuccessCreate'));
        return redirect(route('group.index'));
    }

    public function update(Group $group, Request $request)
    {
        $data = $request->validate([
            'name'  =>  'required',
        ]);

        try {
            $update = $group->update([
                'name'  => $data['name'],
                'ada'  => $data['ada'],
                'dean_act'  => $data['dean_act'],
            ]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        $request->session()->flash('success', __('messages.langSuccessSave'));
        return redirect(route('group.index'));
    }

    public function destroy(Group $group)
    {
        dd('destroy');
    }
}
