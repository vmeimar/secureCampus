<?php

namespace App\Imports;

use App\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class GuardsImport implements ToCollection
{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
//    public function model(array $row)
//    {
//        if ( !is_null($row['onoma_fylaka']) and isset($row['onoma_fylaka']) )
//        {
//            $fullName = explode(' ', $row['onoma_fylaka']);
//
//            return new Guard([
//                'name'  =>  $fullName[1],
//                'surname'   =>  $fullName[0],
//                'company_id'    =>  1,
//            ]);
//        }
//    }

//
//    public function rules(): array
//    {
//        return [
//            'onoma_fylaka' => 'required|string',
//        ];
//    }
//
    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }

    public function collection(Collection $rows)
    {
//        dd(sizeof($rows));

        for ($i=1; $i<sizeof($rows); $i++)
        {
            if ( !is_null($rows[$i][0]) and isset($rows[$i][0]) and ($rows[$i][0] !== 'ΣΥΝΟΛΟ') )
            {
//                print_r($rows[$i][0]);
//                echo "<br>";

                $fullName = explode(' ', $rows[$i][0]);

                return new Guard([
                    'name'  =>  $fullName[1],
                    'surname'   =>  $fullName[0],
                    'company_id'    =>  1,
                ]);
            }
        }

//        foreach ($rows as $row)
//        {
//            if ( !is_null($row['onoma_fylaka']) and isset($row['onoma_fylaka']) and ($row['onoma_fylaka'] !== 'ΣΥΝΟΛΟ') )
//            {
//                $fullName = explode(' ', $row['onoma_fylaka']);
//
//                return new Guard([
//                    'name'  =>  $fullName[1],
//                    'surname'   =>  $fullName[0],
//                    'company_id'    =>  1,
//                ]);
//
//                print_r($fullName[0].' '.$fullName[1]);
//                echo "<br>";
//            }
//        }
    }
}
