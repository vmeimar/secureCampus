<?php

namespace App\Http\Controllers\Admin;

use App\Faculty;
use App\Http\Controllers\Controller;
use App\Location;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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
        $locations = Location::all();
        $roles = Role::all();
        return view('admin.users.edit', compact('roles', 'user', 'locations'));
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
        $user->roles()->sync($request->roles);
        $user->locations()->sync($request->locations);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->department_id = $request->department;

        if ($user->save())
        {
            $request->session()->flash('success', $user->name.' αποθηκεύτηκε επιτυχώς');
        }
        else
        {
            $request->session()->flash('error', 'Παρουσιάστηκε σφάλμα κατά την αποθήκευση του χρήστη '.$user->name);
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
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
