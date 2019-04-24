<?php

namespace App\Imports;

use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    private $department;
    private $role;

    public function __construct($role, $department = null)
    {
        $this->role = $role;
        $this->department = $department;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'username' => $row['username'],
            'password' => config('setting.password'),
            'name' => $row['name'],
            'department_id' => is_null($this->department) ? $row['department'] : $this->department,
            'role_id' => $this->role,
            'phone' => $row['username'],
        ]);
    }
}
