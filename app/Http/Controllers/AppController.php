<?php

namespace App\Http\Controllers;

use App\Imports\HolidaysImport;
use App\Imports\UserEmailImport;
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

    private function populateDaysTable()
    {
        $importedHolidays = DB::table('holidays')->get('date');

        foreach ($importedHolidays as $importedHoliday)
        {
            $importedHolidaysYears[] = date('Y', strtotime($importedHoliday->date));
        }

        $uniqueYears = array_unique($importedHolidaysYears);
        sort($uniqueYears);

        $startDay = reset($uniqueYears).'-01-01';
        $endOfYear = end($uniqueYears).'-12-31';

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
                request()->session()->flash('error', 'Εκδηλώθηκε σφάλμα κατά την εισαγωγή.');
                return redirect(route('app.index'));
            }

            $startDay = date("y-m-d", strtotime("+1 day", strtotime($startDay)));
        }
        request()->session()->flash('success', 'Επιτυχής εισαγωγή.');
        return redirect(route('app.index'));
    }

    private function checkActiveShifts()
    {
        $activeShifts = DB::table('active_shifts')->get();

        foreach ($activeShifts as $activeShift)
        {
            $startDay = date('Y-m-d', strtotime($activeShift->from));
            $endDay = date('Y-m-d', strtotime($activeShift->until));

            if ( (($this->isHoliday($startDay) or $this->isHoliday($endDay)) and $activeShift->is_holiday == 0)
                or ((!$this->isHoliday($startDay) and !$this->isHoliday($endDay)) and $activeShift->is_holiday == 1) )
            {
                $flawedShifts[] = $activeShift;
            }
        }

//        if (!is_null($flawedShifts) and isset($flawedShifts))
//        {
//            dd($flawedShifts);
//        }

        return true;
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
            $request->session()->flash('success', 'Επιτυχής εισαγωγή.');
        } else {
            $request->session()->flash('error', 'Αποτυχία κατά την εισαγωγή.');
        }

        $this->populateDaysTable();
        $this->checkActiveShifts();

        return redirect()->back();
    }

    public function userEmailsImport(Request $request)
    {
        DB::table('user_emails')->truncate();

        if ( Excel::import(new UserEmailImport(), $request->file('import_file')) ) {
            $request->session()->flash('success', 'Επιτυχής εισαγωγή.');
        } else {
            $request->session()->flash('error', 'Αποτυχία κατά την εισαγωγή.');
        }

        return redirect()->back();
    }
}
