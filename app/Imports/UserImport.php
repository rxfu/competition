<?php

namespace App\Imports;

use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'username' => $row['username'],
            'password' => Hash::make(config('settings.password')),
            'name' => $row['name'],
            'department_id' => $row['department'],
            'role_id' => 1,
        ]);
    }
}
