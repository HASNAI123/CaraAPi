<?php

namespace App\Exports;

use App\Models\AcknowledgmentLibrary;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class Library_AcknowledgmentExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return AcknowledgmentLibrary::query();
    }

    public function headings(): array
    {
        return [
            'No.',
            'User Name',
            'role',
            'Terms 1',
            'Terms 2',
            'Date Downloaded',
            'updated_at',
            'created_at',
            'SOP Type',
            'User_id',
            'Sop_title'
        ];
    }
}
