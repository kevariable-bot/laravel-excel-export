<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 3; $month++) {
            $sheets[] = new UsersPerMonthSheet();
        }

        return $sheets;
    }
}
