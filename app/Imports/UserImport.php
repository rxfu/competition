<?php

namespace App\Imports;

use App\Entities\User;
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
            'username' => $row['username'] ?? $row['phone'],
            'password' => $row['password'] ?? config('setting.password'),
            'name' => $row['name'] ?? null,
            'department_id' => is_null($this->department) ? ($row['department'] ?? null) : $this->department,
            'role_id' => $this->role,
            'phone' => $row['phone'] ?? null,
            'gender_id' => $row['gender'] ?? null,
            'course' => $row['course'] ?? null,
            'position' => $row['position'] ?? null,
            'email' => $row['email'] ?? null,
            'idnumber' => $row['idnumber'] ?? null,
            'group_id' => $row['group'] ?? null,
        ]);
    }
}
