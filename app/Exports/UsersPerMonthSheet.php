<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersPerMonthSheet implements FromQuery, WithTitle
{
    /**
     * @return Builder
     */
    public function query()
    {
        return User
            ::query()
            ->where('id', '>', 40);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month ';
    }
}
