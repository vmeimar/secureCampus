<?php

namespace App\Http\Controllers\Admin;

use App\Faculty;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(User $user)
    {
        $faculties = Faculty::all();
        $roles = Role::all();

        return view('admin.users.edit', compact('roles', 'user', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if (Gate::denies('manage-users'))
        {
            return redirect(route('admin.users.index'));
        }

        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->department_id = $request->department;

        if ($user->save())
        {
            $request->session()->flash('success', $user->name.' has been updated');
        }
        else
        {
            $request->session()->flash('error', 'Error while updating user '.$user->name);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if (Gate::denies('manage-users'))
        {
            return redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
