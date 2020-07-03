<?php

namespace App\Exports;

use App\Guard;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllGuardsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->data;
    }

    public function map($guard): array
    {
        return [
            $guard->name,
            $guard->surname,
            0,
            0
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Όνομα',
            'Επώνυμο',
            'Ώρες Εργασίας',
            'Ισοδύναμες Ώρες',
        ];
    }
}
