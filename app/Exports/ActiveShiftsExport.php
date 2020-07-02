<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActiveShiftsExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    //    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()
//    {
//        return ActiveShift::all();
//    }

    public function headings(): array
    {
        return [
            '#',
            'Βάρδια',
            'Φύλακες',
            'Έναρξη',
            'Λήξη',
            'Ισοδύναμες Ώρες'
        ];
    }

    public function map($activeShift): array
    {
        foreach ($activeShift->guards()->get()->toArray() as $guard)
        {
            $fullNames[] = $guard['name'].' '.$guard['surname'];
        }

        return [
            $activeShift->id,
            $activeShift->name,
            implode(', ', $fullNames),
            $activeShift->from,
            $activeShift->until,
            $activeShift->factor
        ];
    }
}
