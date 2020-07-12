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
        $user = $this->get($id);

        $permissions = Cache::rememberForever($user->role->slug . '.permissions', function () use ($user) {
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
        return $this->object->with('role', 'group', 'department', 'gender', 'subject', 'education', 'degree')->whereRoleId(config('setting.player'))->orderBy('group_id')->get();
    }

    public function getAllPlayersByDepartment($id)
    {
        return $this->object->with('role', 'group', 'department', 'gender', 'subject', 'education', 'degree')->whereRoleId(config('setting.player'))->whereDepartmentId($id)->orderBy('group_id')->get();
    }

    public function getAllMarkers()
    {
        return $this->object->with('role', 'group', 'department', 'gender', 'subject', 'education', 'degree')->whereRoleId(config('setting.marker'))->orderBy('group_id')->get();
    }

    public function getAllMarkersByDepartment($id)
    {
        return $this->object->with('role', 'group', 'department', 'gender', 'subject', 'education', 'degree')->whereRoleId(config('setting.marker'))->whereDepartmentId($id)->orderBy('group_id')->get();
    }

    public function getAllPlayersByGroup($id)
    {
        return $this->object->with('group', 'document', 'review')->whereRoleId(config('setting.player'))->whereGroupId($id)->get();
    }

    public function getAll($order = 'id', $direction = 'asc')
    {
        return $this->object->with('role', 'department', 'group')->orderBy($order, $direction)->get();
    }
}
