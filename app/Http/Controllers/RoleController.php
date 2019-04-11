<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use App\Services\RoleService;

class RoleController extends BaseController
{
    protected $module = 'role';

    protected $storeRules = [
        'name' => 'required',
    ];

    private $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->service = $roleService;
        $this->permissionService = $permissionService;

        $this->updateRules = $this->storeRules;
    }

    public function permission($id)
    {
    	$role = $this->service->get($id);
        $items = $this->permissionService->getAll();

        return view('pages.permission', compact('items', 'role'));
    }

    public function assign(Request $request, $id)
    {
        return back()->withSuccess('权限分配成功');
    }
}
