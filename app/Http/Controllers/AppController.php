<?php

namespace App\Http\Controllers;

use App\Imports\HolidaysImport;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('app.index');
    }

    public function populateDaysTable()
    {
        $currentDate = getdate();
        $startDay = $currentDate['year'].'-01-01';
        $endOfYear = $currentDate['year'].'-12-31';

        $this->createDaysTable();

        while ( strtotime($startDay) <= strtotime($endOfYear) )
        {
            $loopingDate = getdate(strtotime($startDay));
            $date = $loopingDate['year'].'-'.$loopingDate['mon'].'-'.$loopingDate['mday'];

            if (! DB::table('days_of_year')->insert([
                'day'   =>  $loopingDate['weekday'],
                'date'  =>  date('Y-m-d', strtotime($date)),
                'is_holiday'    =>  $this->isHoliday($date)
            ]))
            {
                request()->session()->flash('error', 'Εκδηλώθηκε σφάλμα κατά το γέμισμα του πίνακα');
                return redirect(route('app.index'));
            }

            $startDay = date("y-m-d", strtotime("+1 day", strtotime($startDay)));
        }
        request()->session()->flash('success', 'Επιτυχές γέμισμα του πίνακα');
        return redirect(route('app.index'));
    }

    private function isHoliday($date)
    {
        $holiday = DB::table('holidays')
            ->where('date', date('Y-m-d H:i:s', strtotime($date)))
            ->first();

        is_null($holiday) ? $isHoliday = 0 : $isHoliday = 1;
        return $isHoliday;
    }

    private function createDaysTable()
    {
        if (! Schema::hasTable('days_of_year'))
        {
            Schema::create('days_of_year', function (Blueprint $table) {
                $table->id();
                $table->string('day');
                $table->string('date');
                $table->tinyInteger('is_holiday');
                $table->timestamps();
            });
        }
        DB::table('days_of_year')->truncate();
        return true;
    }

    public function import(Request $request)
    {
        DB::table('holidays')->truncate();

        if ( Excel::import(new HolidaysImport(), $request->file('import_file')) ) {
            $request->session()->flash('success', 'Επιτυχής εισαγωγή');
        } else {
            $request->session()->flash('error', 'Αποτυχία κατά την εισαγωγή');
        }

        return redirect()->back();
    }

}
