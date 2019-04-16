<?php

namespace App\Repositories;

use App\Entities\User;
use Cache;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->object = $user;
    }

    public function get($id, $trashed = false)
    {
        try {
            if ($trashed) {
                return $this->object->with('role.permissions')->withTrashed()->findOrFail($id);
            }
        
            return $this->object->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new InternalException($this->getModel() . ': ' . $id . ' 对象不存在', $this->getObject(), 'get', $e);
        }
    }

    public function hasPermission($id, $slug)
    {
        $permissions = Cache::rememberForever('user.permissions', function () use ($id) {
            $user = $this->get($id);
            return $user->role->permissions;
        });

        foreach ($permissions as $permission) {
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
