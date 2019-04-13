<?php

namespace App\Repositories;

use App\Entities\User;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->object = $user;
    }

    public function hasPermission($id, $slug)
    {
        $user = $this->get($id);

        foreach ($user->role->permissions as $permission) {
            if ($slug === $permission->slug) {
                return true;
            }
        }

        return false;
    }
}
