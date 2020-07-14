<?php

namespace App\Imports;

use App\UserEmail;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserEmailImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new UserEmail([
            'email'  =>  $row[0]
        ]);
    }
}
