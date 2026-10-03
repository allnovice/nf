<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {

            if (empty($row['code']) || empty($row['name'])) {
                continue;
            }

            if (Employee::where('code', $row['code'])->exists()) {
                continue;
            }

            Employee::create([
                'code'       => $row['code'],
                'name'       => $row['name'],
                'position'   => $row['position'] ?? null,
                'department' => $row['department'] ?? null,
                'email'      => $row['email'] ?? null,
                'phone'      => $row['phone'] ?? null,
                'bio'        => $row['bio'] ?? null,
            ]);
        }
    }
}
