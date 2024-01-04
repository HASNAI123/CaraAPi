<?php

namespace App\Exports;

use App\Models\Acknowledgment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcknowledgmentExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Acknowledgment::query();
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
