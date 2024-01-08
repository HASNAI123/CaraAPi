<?php

namespace App\Exports;

use App\Models\AcknowledgmentArchive;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Archive_AcknowledgmentExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return AcknowledgmentArchive::query()->select('Sop_title',  'user_name', 'User_id', 'Terms_1', 'Terms_2', 'Date_Downloaded', 'Type');
    }

    public function headings(): array
    {
        return [
            'Sop_title',
            'Employee Name',
            'Employee id',
            'Terms 1',
            'Terms 2',
            'Date Downloaded',
            'SOP Type',
            'created_at',
            'updated_at',
        ];
    }

}


