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

    public function getAllPlayers()
    {
        return $this->object->with('role', 'group', 'department', 'gender', 'subject', 'education', 'degree')->whereRoleId(config('setting.player'))->get();
    }

    public function getAllPlayersByDepartment($id)
    {
        return $this->object->with('role', 'group', 'department', 'gender', 'subject', 'education', 'degree')->whereRoleId(config('setting.player'))->whereDepartmentId($id)->get();
    }

    public function getAllMarkers()
    {
        return $this->object->whereRoleId(config('setting.marker'))->get();
    }

    public function getAllMarkersByDepartment($id)
    {
        return $this->object->whereRoleId(config('setting.marker'))->whereDepartmentId($id)->get();
    }

    public function getAllPlayersByGroup($id)
    {
        return $this->object->whereRoleId(config('setting.player'))->whereGroupId($id)->get();
    }
}
