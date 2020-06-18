<?php

namespace App\Imports;

use App\Holiday;
use Maatwebsite\Excel\Concerns\ToModel;

class HolidaysImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = str_replace('/', '-', $row[1]);

        return new Holiday([
            'name'  =>  $row[0],
            'date'  =>  date('Y-m-d', strtotime($date)),
        ]);
    }
}
