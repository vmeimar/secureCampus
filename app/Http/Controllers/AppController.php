<?php

namespace App\Http\Controllers;

use App\Imports\GuardsImport;
use App\Imports\HolidaysImport;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class AppController extends Controller
{
    public function index()
    {
        return view('app.index');
    }

    public function populateDaysTable()
    {
        $currentDate = getdate();
        $startDay = $currentDate['year'].'-01-01';
        $endOfYear = $currentDate['year'].'-12-31';

        while ( strtotime($startDay) <= strtotime($endOfYear) )
        {
            $loopingDate = getdate(strtotime($startDay));
            $date = $loopingDate['year'].'-'.$loopingDate['mon'].'-'.$loopingDate['year'];

            DB::table('days_of_year')->insert([
                'day'   =>  $loopingDate['weekday'],
                'date'  =>  $date,
                'is_holiday'    =>  $this->isHoliday($date)
                ]);

            $startDay = date("y-m-d", strtotime("+1 day", strtotime($startDay)));
        }

    }


    private function isHoliday($date)
    {

    }

    private function createDaysTable()
    {
        if (! Schema::hasTable('days_of_year'))
        {
            if (Schema::create('days_of_year', function (Blueprint $table) {
                $table->id();
                $table->string('day');
                $table->string('date');
                $table->tinyInteger('is_holiday');
                $table->timestamps();
            })) {
                return true;
            }
            else
            {
                request()->session()->flash('error', 'Σφάλμα κατά τη δημιουργία του πίνακα days_of_year');
                return false;
            }
        }
        return true;
    }


    public function import(Request $request)
    {
        DB::table('holidays')->truncate();

        if (Excel::import(new HolidaysImport(), $request->file('import_file')))
        {
            $request->session()->flash('success', 'Επιτυχής εισαγωγή');
        }
        else
        {
            $request->session()->flash('error', 'Αποτυχία κατά την εισαγωγή');
        }

        return redirect()->back();
    }

}
