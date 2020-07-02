<?php

namespace App\Exports;

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

    public function headings(): array
    {
        return [
            '#',
            'Βάρδια',
            'Φύλακες',
            'Έναρξη',
            'Λήξη',
            'Διάρκεια',
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
            date('d/m/Y H:i:s', strtotime($activeShift->from)),
            date('d/m/Y H:i:s', strtotime($activeShift->until)),
            $activeShift->duration,
            $activeShift->factor
        ];
    }
}
