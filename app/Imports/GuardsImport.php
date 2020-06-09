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
            'name'  =>  $row[0],
            'surname'   =>  $row[1],
            'company_id'    =>  Company::where('name', $row[2])->value('id'),
        ]);
    }
}
