<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        if ( ($row['onoma'] != '') and !$this->userAlreadyExists($row['dieuthinsi_ilektronikou_takhidromioy_e_mail']) ) {
//            echo "<pre>";
//            print_r($row);
//            echo "<br>";
//        }
        if ( ($row['onoma'] != '') and !$this->userAlreadyExists($row['dieuthinsi_ilektronikou_takhidromioy_e_mail']) )
        {
            return new User([
                'name'  =>  $row['onoma'],
                'email' =>  $row['dieuthinsi_ilektronikou_takhidromioy_e_mail']
            ]);
        }
    }

    private function userAlreadyExists($email)
    {
        if (User::where('email', '=', $email)->exists())
        {
            return true;
        }
        return false;
    }
}
