<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Location;
use App\Role;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|RedirectResponse|Redirector
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
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $userAssignedRoles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        if (in_array('epitropi', $userAssignedRoles))
        {
            $allLocations = Location::pluck('id')->toArray();
            $user->locations()->sync($allLocations);
        }
        else
        {
            $user->locations()->sync($request->locations);
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->tier = $request->tier;
        $user->email = $request->email;

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
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
