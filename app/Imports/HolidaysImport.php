<?php

namespace App\Imports;

use App\Holiday;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class HolidaysImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Holiday([
            'name'  =>  $row[0],
            'date'  =>  $row[1],
        ]);
    }
}
