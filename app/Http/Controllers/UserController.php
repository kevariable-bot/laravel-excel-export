<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __invoke()
    {
        Excel::store(new UsersExport, 'users.xlsx');

        return 'tersimpan';
    }
}
