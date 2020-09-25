<?php

namespace App\Imports;

use App\UserEmail;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserEmailImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new UserEmail([
            'name'  =>  $row['onoma'],
            'surname'   =>  $row['eponymo'],
            'email'  =>  $row['email'],
        ]);
    }
}
