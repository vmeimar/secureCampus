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
        $highestRow = $worksheet->getHighestRow();

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

            return new Guard([
                'name'  =>  $fullName[1],
                'surname'   =>  $fullName[0],
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
}
