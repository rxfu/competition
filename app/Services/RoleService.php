<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Cache;

class RoleService extends Service
{
    public function __construct(RoleRepository $roles)
    {
        $this->repository = $roles;
    }

    public function getPermissions()
    {
        return $this->repository->getPermissions();
    }

    public function getAssignedPermissions($id)
    {
        try {
            $object = $this->repository->get($id);

            return $object->permissions()->pluck('permission_id');
        } catch (QueryException $e) {
            throw new InternalException('获取分配权限失败', $this->getObject(), 'get', $e);
        }
    }

    public function assignPermissions($id, $permissions)
    {
        try {
            $object = $this->repository->get($id);

            $object->permissions()->sync($permissions);

            Cache::forget('permissions');
            Cache::forget($object->slug . '.permissions');
        } catch (QueryException $e) {
            throw new InternalException('角色分配权限失败', $this->getObject(), 'insert', $e);
        }
    }
}
