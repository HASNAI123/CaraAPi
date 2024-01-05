<?php

namespace App\Exports;

use App\Models\AcknowledgmentArchive;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Archive_AcknowledgmentExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return AcknowledgmentArchive::query();
    }

    public function headings(): array
    {
        return [
            'User ID',
            'User Name',
            'role',
            'Terms 1',
            'Terms 2',
            'Date Downloaded',
            'updated_at',
            'created_at',
            'SOP Type',
            'user_id'
        ];
    }

}


