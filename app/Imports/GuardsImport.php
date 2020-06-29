<?php

namespace App\Imports;

use App\Guard;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;

class GuardsImport implements ToModel, WithValidation, WithHeadingRow, WithMultipleSheets, WithEvents
{
    use Importable, RegistersEventListeners;

    public static function beforeImport(BeforeImport $event)
    {
        $worksheet = $event->reader->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        if ($highestRow < 2) {
            $error = \Illuminate\Validation\ValidationException::withMessages([]);
            $failure = new Failure(1, 'rows', [0 => 'Now enough rows!']);
            $failures = [0 => $failure];
            throw new ValidationException($error, $failures);
        }
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        echo "<pre>";

        if ( !is_null($row['onoma_fylaka']) and isset($row['onoma_fylaka']) and $row['onoma_fylaka'] !== 'ΣΥΝΟΛΟ' )
        {
            $fullName = explode(' ', $row['onoma_fylaka']);

//            print_r($fullName);

            return new Guard([
                'name'  =>  $fullName[0],
                'surname'   =>  $fullName[1],
                'company_id'    =>  1,
            ]);
        }
    }


    public function sheets(): array
    {
        return [
            // Select by sheet index
            0 => new GuardsImport(),
        ];
    }

    public function rules(): array
    {
        return [
//            'onoma_fylaka' => 'string',
//            '*.onoma_fylaka' => 'string',
        ];
    }


//    public function collection(Collection $rows)
//    {
//        for ($i=1; $i<sizeof($rows); $i++)
//        {
//            if ( !is_null($rows[$i][0]) and isset($rows[$i][0]) and ($rows[$i][0] !== 'ΣΥΝΟΛΟ') )
//            {
//                print_r($rows[$i][0]);
//                echo "<br>";
//
//                $fullName = explode(' ', $rows[$i][0]);
//
//                return $fullName;
//
//                return new Guard([
//                    'name'  =>  $fullName[1],
//                    'surname'   =>  $fullName[0],
//                    'company_id'    =>  1,
//                ]);
//            }
//        }

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
//    }
}
