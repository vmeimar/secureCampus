<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupUsersController extends Controller
{
    public function index(Group $group)
    {
        return view('group-user.index', compact('group'));
    }
}
