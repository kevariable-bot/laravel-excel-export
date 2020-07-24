<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithMultipleSheets
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

    public function query()
    {
        return User::where('id', '>', 25);
    }

    public function map($user): array
    {
        return [
            'ini id ke - ' . $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at)
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Time'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
