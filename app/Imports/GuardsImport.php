<?php

namespace App\Imports;

use App\Company;
use App\Guard;
use Maatwebsite\Excel\Concerns\ToModel;

class GuardsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Guard([
            'name'  =>  $row[1],
            'surname'   =>  $row[2],
            'company_id'    =>  Company::where('name', $row[3])->value('id'),
        ]);
    }
}
