<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Group;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GroupUsersController extends Controller
{
    public function index(Group $group)
    {
        return view('group-user.index', compact('group'));
    }

    public function importExportView()
    {
        //
    }

    public function import()
    {
        Excel::import(new UsersImport, \request()->file('file'));
        exit;
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
