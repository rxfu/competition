<?php

namespace App\Repositories;

use App\Entities\Role;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class RoleRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->object = $role;
    }

    public function getPermissions()
    {
        return $this->object->permissions()->pluck('slug');
    }
}
