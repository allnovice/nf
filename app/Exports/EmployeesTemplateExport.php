<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesTemplateExport implements FromCollection
{
public function collection(): Collection
{
    return collect([
        [
            'code',
            'name',
            'position',
            'department',
            'email',
            'phone',
            'bio',
            'facebook',
            'instagram',
            'linkedin',
            'x',
            'github',
            'viber',
            'telegram',
            'messenger',
            'whatsapp',
            'youtube',
            'tiktok',
            'threads',
        ],
    ]);
}
}
