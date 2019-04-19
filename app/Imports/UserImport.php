<?php

namespace App\Imports;

use App\Entities\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'username' => $row[0],
            'name' => $row[1],
            'department_id' => $row[2],
            'role_id' => 1,
        ]);
    }
}
