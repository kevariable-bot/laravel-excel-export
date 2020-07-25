<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents; // import dan gunakan di implement
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class UsersPerMonthSheet implements FromQuery, WithTitle, WithHeadings, WithEvents
{
    /**
     * @return Builder
     */
    public function query()
    {
        return User
            ::query();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month '; // nama sheet yang sebelumnya digunakan pada WithMultipleSheet.
    }

    public function headings(): array
    {
        // heading yang akan digunakan nantinya untuk dibuat bold
        return [
            'id',
            'name',
            'point',
            'email',
            'email verification',
            'update_at',
            'created_at'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->setCellValue('A1', 'Hello');
            },

            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(/* line ke 7 */7, /* row yang mau ditambah */ 2);
                $event->sheet->insertNewColumnBefore('A', /* row yang mau ditambah */ 2);
            }
        ];
    }
}
