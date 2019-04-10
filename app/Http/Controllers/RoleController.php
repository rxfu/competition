<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveRoleRequest;
use App\Services\RoleService;

class RoleController extends BaseController
{
    public function __construct(RoleService $roleService, SaveRoleRequest $request)
    {
        $this->service = $roleService;
        $this->request = $request;
    }

    public function store(SaveRoleRequest $request)
    {
        return $this->postSave($request);
    }

    public function update(SaveRoleRequest $request, $id)
    {
        return $this->putSave($request, $id);
    }
}
